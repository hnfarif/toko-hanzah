<?php

namespace App\Http\Controllers;

use App\Pembelian;
use App\Barang;
use App\Pemasok;
use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian = Pembelian::all();

        return view('admin.tabel_transaksi.pembelian.tabel', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataBarang = session('data_barang');

        foreach ($dataBarang as $item) {

            $originalDate = $item['tanggal_beli'];
            $newDate = date("Y-m-d", strtotime($originalDate));

            $barang = new Barang();

            $cekbarang = DB::table('barang')->where('nama_barang', '=', $item['nama_barang'])->first();

            $stok = DB::table('barang')
                ->select('stock')
                ->where('nama_barang','=', $item['nama_barang'])
                ->first();

            $totaljual = DB::table('barang')
            ->select('harga_satuan_jual')
            ->where('nama_barang','=', $item['nama_barang'])
            ->first();

            if (is_null($cekbarang)) {

                if($item['satuan'] == "liter" || $item['satuan'] == "kg"){

                    $barang->nama_barang = ucwords($item['nama_barang']);
                    $barang->stock = $item['jumlah'];
                    $barang->satuan = $item['satuan'];
                    $barang->harga_satuan_beli = $item['harga_satuan'];
                    $barang->harga_satuan_jual = 0;
                    $barang->total_harga_beli = $item['jumlah'] * $item['harga_satuan'];
                    $barang->total_harga_jual = 0;
                    $barang->gambar_barang = "";



                }else if($item['satuan'] == 'renceng' || $item['satuan'] == 'pack' ){

                    if($item['jml'] != null){

                        $barang->nama_barang = ucwords($item['nama_barang']);
                        $barang->stock = $item['jumlah'] * $item['jml'];
                        $barang->satuan = "pcs";
                        $barang->harga_satuan_beli = $item['harga_satuan'] / $item['jml'];
                        $barang->harga_satuan_jual = 0;
                        $barang->total_harga_beli = ($item['jml'] * $item['jumlah']) * ($item['harga_satuan']/$item['jml']);
                        $barang->total_harga_jual = 0;
                        $barang->gambar_barang = "";

                    }else{
                        $barang->nama_barang = ucwords($item['nama_barang']);
                        $barang->stock = $item['jumlah'];
                        $barang->satuan = $item['satuan'];
                        $barang->harga_satuan_beli = $item['harga_satuan'];
                        $barang->harga_satuan_jual = 0;
                        $barang->total_harga_beli = $item['jumlah'] * $item['harga_satuan'];
                        $barang->total_harga_jual = 0;
                        $barang->gambar_barang = "";
                    }

                }else{

                    $barang->nama_barang = ucwords($item['nama_barang']);
                    $barang->stock = $item['jumlah'];
                    $barang->satuan = $item['satuan'];
                    $barang->harga_satuan_beli = $item['harga_satuan'];
                    $barang->harga_satuan_jual = 0;
                    $barang->total_harga_beli = $item['jumlah'] * $item['harga_satuan'];
                    $barang->total_harga_jual = 0;
                    $barang->gambar_barang = "";

                }
                $barang->save();

            } else {

                if($item['satuan'] == "liter" || $item['satuan'] == "kg"){

                    Barang::where('nama_barang', $item['nama_barang'])->update([

                        'stock' => $stok->stock + $item['jumlah'],
                        'harga_satuan_beli' => $item['harga_satuan'],
                        'total_harga_beli' => ($stok->stock + $item['jumlah']) * $item['harga_satuan'],
                        'total_harga_jual' => ($stok->stock + $item['jumlah']) * $totaljual->harga_satuan_jual

                    ]);

                }else if($item['satuan'] == 'renceng' || $item['satuan'] == 'pack' ){

                    if($item['jml'] != null){
                        Barang::where('nama_barang', $item['nama_barang'])->update([

                            'stock' => $stok->stock + ($item['jumlah'] * $item['jml']),
                            'harga_satuan_beli' => $item['harga_satuan'] / $item['jml'],
                            'total_harga_beli' => ($stok->stock + ($item['jumlah'] * $item['jml'])) * ($item['harga_satuan'] / $item['jml']),
                            'total_harga_jual' => ($stok->stock + ($item['jumlah'] * $item['jml'])) * $totaljual->harga_satuan_jual

                        ]);
                    }else{
                        Barang::where('nama_barang', $item['nama_barang'])->update([

                            'stock' => $stok->stock + $item['jumlah'],
                            'harga_satuan_beli' => $item['harga_satuan'],
                            'total_harga_beli' => ($stok->stock + $item['jumlah']) * $item['harga_satuan'],
                            'total_harga_jual' => ($stok->stock + $item['jumlah']) * $totaljual->harga_satuan_jual

                        ]);
                    }


                }else{

                    Barang::where('nama_barang', $item['nama_barang'])->update([

                        'stock' => $stok->stock + $item['jumlah'],
                        'harga_satuan_beli' => $item['harga_satuan'],
                        'total_harga_beli' => ($stok->stock + $item['jumlah']) * $item['harga_satuan'],
                        'total_harga_jual' => ($stok->stock + $item['jumlah']) * $totaljual->harga_satuan_jual

                    ]);
                }

            }

            $cekPemasok = DB::table('pemasok')->where('nama_pemasok', '=', $item['nama_toko'])->first();

            if (is_null($cekPemasok)) {

                $pemasok = new Pemasok();

                $pemasok->nama_pemasok = ucwords($item['nama_toko']);
                $pemasok->alamat_pemasok = "";
                $pemasok->no_hp = "";
                $pemasok->save();
            }

            $idBarang = DB::table('barang')
            ->select('id')
            ->where('nama_barang','=', $item['nama_barang'])
            ->first();

            $idToko = DB::table('pemasok')
            ->select('id')
            ->where('nama_pemasok','=', $item['nama_toko'])
            ->first();

            $pembelian = new Pembelian();

            $pembelian->id_barang = $idBarang->id;
            $pembelian->id_toko = $idToko->id;
            $pembelian->nama_barang = ucwords($item['nama_barang']);
            $pembelian->nama_toko = ucwords($item['nama_toko']);
            $pembelian->tanggal_beli = $newDate;
            $pembelian->jumlah = $item['jumlah'];
            $pembelian->jumlah_pcs = $item['jml'];
            $pembelian->satuan = $item['satuan'];
            $pembelian->harga_satuan = $item['harga_satuan'];
            $pembelian->total = $item['total'];

            $pembelian->save();


        }

        session()->forget('data_barang');
        return redirect('/pembelian')->with('status', 'Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        $dataBarang = session('data_barang');

        // session()->forget('data_barang');

        $total = 0;
        if($dataBarang){
            foreach ($dataBarang ?? '' as $item) {


                $total += $item['total'];
            }
        }else{
            $dataBarang = [];
        }

        $satuan = Satuan::all();

        // dd($dataBarang);
        return view('admin.tabel_transaksi.pembelian.input', ['data_barang' => $dataBarang, 'total' => $total, 'satuan' => $satuan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        $satuan = Satuan::all();

        return view('admin.tabel_transaksi.pembelian.edit', compact('pembelian', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        $stok = DB::table('barang')
                ->select('stock')
                ->where('nama_barang','=', $request->nama_barang)
                ->first();

        $totaljual = DB::table('barang')
                ->select('harga_satuan_jual')
                ->where('nama_barang','=', $request->nama_barang)
                ->first();
        $originalDate = $request->tanggal_beli;
        $newDate = date("Y-m-d", strtotime($originalDate));

                if($request->satuan == "liter" || $request->satuan == "kg"){

                    if($request->jumlah > $pembelian->jumlah){

                        $penambahan = $request->jumlah - $pembelian->jumlah;

                        Barang::where('nama_barang', $request->nama_barang)->update([

                            'stock' => $stok->stock + $penambahan,
                            'harga_satuan_beli' => $request->harga_satuan,
                            'total_harga_beli' => ($stok->stock + $penambahan) * $request->harga_satuan,
                            'total_harga_jual' => ($stok->stock + $penambahan) * $totaljual->harga_satuan_jual

                        ]);

                    }else if($request->jumlah < $pembelian->jumlah) {

                        $pengurangan = $pembelian->jumlah - $request->jumlah;

                        Barang::where('nama_barang', $request->nama_barang)->update([

                            'stock' => $stok->stock - $pengurangan,
                            'harga_satuan_beli' => $request->harga_satuan,
                            'total_harga_beli' => ($stok->stock - $pengurangan) * $request->harga_satuan,
                            'total_harga_jual' => ($stok->stock - $pengurangan) * $totaljual->harga_satuan_jual

                        ]);
                    }else{
                        Barang::where('nama_barang', $request->nama_barang)->update([

                            'stock' => $stok->stock,
                            'harga_satuan_beli' => $request->harga_satuan,
                            'total_harga_beli' => ($stok->stock) * $request->harga_satuan,
                            'total_harga_jual' => ($stok->stock) * $totaljual->harga_satuan_jual

                        ]);
                    }


                }else if($request->satuan == 'renceng' || $request->satuan == 'pack' ){

                    if($request->jml != null){

                        if($request->jumlah > $pembelian->jumlah){

                            $penambahan = $request->jumlah - $pembelian->jumlah;

                            Barang::where('nama_barang', $request->nama_barang)->update([

                                'stock' => $stok->stock + ($penambahan * $request->jml),
                                'harga_satuan_beli' => $request->harga_satuan / $request->jml,
                                'total_harga_beli' => ($stok->stock + ($penambahan * $request->jml)) * ($request->harga_satuan / $request->jml),
                                'total_harga_jual' => ($stok->stock + ($penambahan * $request->jml)) * $totaljual->harga_satuan_jual

                            ]);


                        }else if($request->jumlah < $pembelian->jumlah) {

                            $pengurangan = $pembelian->jumlah - $request->jumlah;

                            Barang::where('nama_barang', $request->nama_barang)->update([

                                'stock' => $stok->stock - ($pengurangan * $request->jml),
                                'harga_satuan_beli' => $request->harga_satuan / $request->jml,
                                'total_harga_beli' => ($stok->stock - ($pengurangan * $request->jml)) * ($request->harga_satuan / $request->jml),
                                'total_harga_jual' => ($stok->stock - ($pengurangan * $request->jml)) * $totaljual->harga_satuan_jual

                            ]);

                        }else{
                            Barang::where('nama_barang', $request->nama_barang)->update([

                                'stock' => $stok->stock,
                                'harga_satuan_beli' => $request->harga_satuan / $request->jml,
                                'total_harga_beli' => ($stok->stock) * ($request->harga_satuan / $request->jml),
                                'total_harga_jual' => ($stok->stock) * $totaljual->harga_satuan_jual

                            ]);
                        }


                    }else{

                        if($request->jumlah > $pembelian->jumlah){

                            $penambahan = $request->jumlah - $pembelian->jumlah;

                            Barang::where('nama_barang', $request->nama_barang)->update([

                                'stock' => $stok->stock + $penambahan,
                                'harga_satuan_beli' => $request->harga_satuan,
                                'total_harga_beli' => ($stok->stock + $penambahan) * $request->harga_satuan,
                                'total_harga_jual' => ($stok->stock + $penambahan) * $totaljual->harga_satuan_jual

                            ]);


                        }else if($request->jumlah < $pembelian->jumlah) {

                            $pengurangan = $pembelian->jumlah - $request->jumlah;

                            Barang::where('nama_barang', $request->nama_barang)->update([

                                'stock' => $stok->stock - $pengurangan,
                                'harga_satuan_beli' => $request->harga_satuan,
                                'total_harga_beli' => ($stok->stock - $pengurangan) * $request->harga_satuan,
                                'total_harga_jual' => ($stok->stock - $pengurangan) * $totaljual->harga_satuan_jual

                            ]);

                        }else{

                            Barang::where('nama_barang', $request->nama_barang)->update([

                                'stock' => $stok->stock,
                                'harga_satuan_beli' => $request->harga_satuan,
                                'total_harga_beli' => ($stok->stock) * $request->harga_satuan,
                                'total_harga_jual' => ($stok->stock) * $totaljual->harga_satuan_jual

                            ]);

                        }


                    }


                }else{

                    if($request->jumlah > $pembelian->jumlah){

                        $penambahan = $request->jumlah - $pembelian->jumlah;

                        Barang::where('nama_barang', $request->nama_barang)->update([

                            'stock' => $stok->stock + $penambahan,
                            'harga_satuan_beli' => $request->harga_satuan,
                            'total_harga_beli' => ($stok->stock + $penambahan) * $request->harga_satuan,
                            'total_harga_jual' => ($stok->stock + $penambahan) * $totaljual->harga_satuan_jual

                        ]);


                    }else if($request->jumlah < $pembelian->jumlah) {

                        $pengurangan = $pembelian->jumlah - $request->jumlah;

                        Barang::where('nama_barang', $request->nama_barang)->update([

                            'stock' => $stok->stock - $pengurangan,
                            'harga_satuan_beli' => $request->harga_satuan,
                            'total_harga_beli' => ($stok->stock - $pengurangan) * $request->harga_satuan,
                            'total_harga_jual' => ($stok->stock - $pengurangan) * $totaljual->harga_satuan_jual

                        ]);

                    }else{

                        Barang::where('nama_barang', $request->nama_barang)->update([

                            'stock' => $stok->stock,
                            'harga_satuan_beli' => $request->harga_satuan,
                            'total_harga_beli' => ($stok->stock) * $request->harga_satuan,
                            'total_harga_jual' => ($stok->stock) * $totaljual->harga_satuan_jual

                        ]);
                    }


                }

        Pembelian::where('id', $pembelian->id)->update([

            'nama_toko' => $request->nama_toko,
            'tanggal_beli' => $newDate,
            'jumlah' => $request->jumlah,
            'jumlah_pcs' => $request->jml,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'total' => $request->total

        ]);

            return redirect('/pembelian')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        $stok = DB::table('barang')
                ->select('stock')
                ->where('nama_barang','=', $pembelian->nama_barang)
                ->first();

        $satuanjual = DB::table('barang')
        ->select('harga_satuan_jual')
        ->where('nama_barang','=', $pembelian->nama_barang)
        ->first();

        $satuanbeli = DB::table('barang')
        ->select('harga_satuan_beli')
        ->where('nama_barang','=', $pembelian->nama_barang)
        ->first();

        if($pembelian->jumlah_pcs != null){
            Barang::where('nama_barang', $pembelian->nama_barang)->update([
                'stock' => $stok->stock - ($pembelian->jumlah * $pembelian->jumlah_pcs),
                'total_harga_beli' =>  ($stok->stock - ($pembelian->jumlah * $pembelian->jumlah_pcs)) * $satuanbeli->harga_satuan_beli,
                'total_harga_jual' => ($stok->stock - ($pembelian->jumlah * $pembelian->jumlah_pcs)) * $satuanjual->harga_satuan_jual
            ]);
        }else{
            Barang::where('nama_barang', $pembelian->nama_barang)->update([
                'stock' => $stok->stock - $pembelian->jumlah,
                'total_harga_beli' =>  ($stok->stock - $pembelian->jumlah) * $satuanbeli->harga_satuan_beli,
                'total_harga_jual' => ($stok->stock - $pembelian->jumlah) * $satuanjual->harga_satuan_jual
            ]);
        }

        Pembelian::destroy($pembelian->id);

        return redirect('/pembelian')->with('status', 'Data Berhasil Dihapus!');
    }

    public function listBarang(Request $request){

        $request->validate([

            'nama_barang' => 'required',
            'nama_toko' => 'required',
            'tanggal_beli' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required'
        ]);

        $daftarBarang =  $request->all();

        $listBarang = [];

        if(session()->has('data_barang')){

            $dataBarang = session('data_barang');

            foreach ($dataBarang as $item) {

                array_push($listBarang, $item);
            }

            array_push($listBarang, $daftarBarang);
        }else{
            array_push($listBarang, $daftarBarang);
        }

        session(['data_barang' => $listBarang]);
        // dd($listBarang);

        return redirect('/pembelian/input');
    }

    public function dataBarang(Request $request){

        if($request->ajax()){

            $barang = Barang::all();

            return response()->json($barang);
        }
    }

    public function dataToko(Request $request){

        if($request->ajax()){

            $pemasok = Pemasok::all();

            return response()->json($pemasok);
        }
    }

    public function deleteBarang($namabarang)
    {

        $dataBarang = session('data_barang');

        $barangUpdate = [];

        foreach ($dataBarang as $item) {
            if ($namabarang == $item['nama_barang']) {
                unset($item);
            } else {
                array_push($barangUpdate, $item);
            }
        }

        session(['data_barang' => $barangUpdate]);

        return redirect('/pembelian/input');
    }

    public function cetak_pdf(){

        $pembelian = session('filterVal');

        $pdf = PDF::loadview('admin.tabel_transaksi.pembelian.cetak', ['pembelian' => $pembelian]);

        return $pdf->stream();
    }

    public function getFilter(Request $request){

        $query = DB::table('pembelian')
                    ->where('id', 'like', '%'. $request->filter.'%')
                    ->orWhere('nama_barang', 'like', '%'. $request->filter.'%')
                    ->orWhere('nama_toko', 'like', '%'. $request->filter.'%')
                    ->orWhere('tanggal_beli', 'like', '%'. $request->filter.'%')
                    ->orWhere('jumlah', 'like', '%'. $request->filter.'%')
                    ->orWhere('satuan', 'like', '%'. $request->filter.'%')
                    ->orWhere('harga_satuan', 'like', '%'. $request->filter.'%')
                    ->orWhere('total', 'like', '%'. $request->filter.'%')
                    ->get();

        $url = "http://127.0.0.1:8000/pembelian/cetak-pdf";
        $urlin = "/pembelian";
        session(['filterVal' => $query]);
        echo "<script>window.open('".$url."', '_blank')
        setTimeout(function(){location.href='".$urlin."'; }, 2000);
        </script>";

    }

}
