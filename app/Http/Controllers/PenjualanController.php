<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Barang;
use App\Penjualan;
use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::all();

        return view('admin.tabel_transaksi.penjualan.tabel', compact('penjualan'));
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
        $dataBarang = session('data_brg_jual');

        foreach ($dataBarang as $item) {

            $originalDate = $item['tanggal'];
            $newDate = date("Y-m-d", strtotime($originalDate));

            $stok = DB::table('barang')
                ->select('stock')
                ->where('nama_barang','=', $item['nama_barang'])
                ->first();

            $totaljual = DB::table('barang')
            ->select('harga_satuan_jual')
            ->where('nama_barang','=', $item['nama_barang'])
            ->first();

            $totalBeli = DB::table('barang')
            ->select('harga_satuan_beli')
            ->where('nama_barang','=', $item['nama_barang'])
            ->first();

            $minusVal = $stok->stock - $item['jumlah'];
            if($minusVal < 0){

                return redirect('/penjualan')->with('failed', 'Data tidak berhasil di input, karena nilai stok minus! mohon cek kembali ');

            }else{

                if($item['satuan'] == "liter" || $item['satuan'] == "kg"){

                    Barang::where('nama_barang', $item['nama_barang'])->update([

                        'stock' => $stok->stock - $item['jumlah'],
                        'total_harga_beli' => ($stok->stock - $item['jumlah']) * $totalBeli->harga_satuan_beli,
                        'total_harga_jual' => ($stok->stock - $item['jumlah']) * $totaljual->harga_satuan_jual

                    ]);

                }else if($item['satuan'] == 'renceng' || $item['satuan'] == 'pack' ){

                    if($item['jml'] != null){
                        Barang::where('nama_barang', $item['nama_barang'])->update([

                            'stock' => $stok->stock - ($item['jumlah'] * $item['jml']),
                            'total_harga_beli' => ($stok->stock - ($item['jumlah'] * $item['jml'])) * ( $totalBeli->harga_satuan_beli / $item['jml']),
                            'total_harga_jual' => ($stok->stock - ($item['jumlah'] * $item['jml'])) * $totaljual->harga_satuan_jual

                        ]);
                    }else{
                        Barang::where('nama_barang', $item['nama_barang'])->update([

                            'stock' => $stok->stock - $item['jumlah'],
                            'total_harga_beli' => ($stok->stock - $item['jumlah']) * $totalBeli->harga_satuan_beli,
                            'total_harga_jual' => ($stok->stock - $item['jumlah']) * $totaljual->harga_satuan_jual

                        ]);
                    }


                }else{

                    Barang::where('nama_barang', $item['nama_barang'])->update([

                        'stock' => $stok->stock - $item['jumlah'],
                        'total_harga_beli' => ($stok->stock - $item['jumlah']) * $totalBeli->harga_satuan_beli,
                        'total_harga_jual' => ($stok->stock - $item['jumlah']) * $totaljual->harga_satuan_jual

                    ]);
                }
            }

            $cekPelanggan = DB::table('pelanggan')->where('nama_pelanggan', '=', $item['nama_pelanggan'])->first();

            if (is_null($cekPelanggan)) {

                $pelanggan = new Pelanggan();

                $pelanggan->nama_pelanggan = ucwords($item['nama_pelanggan']);
                $pelanggan->alamat = "";

                $pelanggan->save();
            }

            $idBarang = DB::table('barang')
            ->select('id')
            ->where('nama_barang','=', $item['nama_barang'])
            ->first();

            $idPelanggan = DB::table('pelanggan')
            ->select('id')
            ->where('nama_pelanggan','=', $item['nama_pelanggan'])
            ->first();

            $penjualan = new Penjualan();

            $penjualan->id_pelanggan = $idPelanggan->id;
            $penjualan->id_barang = $idBarang->id;
            $penjualan->nama_pelanggan = ucwords($item['nama_pelanggan']);
            $penjualan->nama_barang = ucwords($item['nama_barang']);
            $penjualan->tanggal = $newDate;
            $penjualan->jumlah = $item['jumlah'];
            $penjualan->satuan = $item['satuan'];
            $penjualan->harga_satuan = $item['harga_satuan'];
            $penjualan->total = $item['total'];

            $penjualan->save();
        }

        session()->forget('data_brg_jual');
        return redirect('/penjualan')->with('status', 'Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        $dataBarang = session('data_brg_jual');

        // session()->forget('data_barang');

        $total = 0;
        $pelanggan = '';

        if($dataBarang){
            foreach ($dataBarang ?? '' as $item) {


                $total += $item['total'];
                $pelanggan = $item['nama_pelanggan'];
            }
        }else{
            $dataBarang = [];
        }

        $satuan = Satuan::all();


        return view('admin.tabel_transaksi.penjualan.input', compact('satuan','total','dataBarang','pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        $satuan = Satuan::all();

        return view('admin.tabel_transaksi.penjualan.edit', compact('penjualan', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $stok = DB::table('barang')
                ->select('stock')
                ->where('nama_barang','=', $request->nama_barang)
                ->first();

        $totaljual = DB::table('barang')
                ->select('harga_satuan_jual')
                ->where('nama_barang','=', $request->nama_barang)
                ->first();

        $hrgSatuan = DB::table('barang')
                ->select('harga_satuan_beli')
                ->where('nama_barang','=', $request->nama_barang)
                ->first();
        $originalDate = $request->tanggal;
        $newDate = date("Y-m-d", strtotime($originalDate));


        if($request->satuan == "liter" || $request->satuan == "kg"){

            if($request->jumlah > $penjualan->jumlah){

                $penambahan = $request->jumlah - $penjualan->jumlah;

                Barang::where('nama_barang', $request->nama_barang)->update([

                    'stock' => $stok->stock - $penambahan,
                    'total_harga_beli' => ($stok->stock - $penambahan) * $hrgSatuan->harga_satuan_beli,
                    'total_harga_jual' => ($stok->stock - $penambahan) * $totaljual->harga_satuan_jual

                ]);

            }else if($request->jumlah < $penjualan->jumlah) {

                $pengurangan = $penjualan->jumlah - $request->jumlah;

                Barang::where('nama_barang', $request->nama_barang)->update([

                    'stock' => $stok->stock + $pengurangan,
                    'total_harga_beli' => ($stok->stock + $pengurangan) * $hrgSatuan->harga_satuan_beli,
                    'total_harga_jual' => ($stok->stock + $pengurangan) * $totaljual->harga_satuan_jual

                ]);
            }


        }else if($request->satuan == 'renceng' || $request->satuan == 'pack' ){


                if($request->jumlah > $penjualan->jumlah){

                    $penambahan = $request->jumlah - $penjualan->jumlah;

                    Barang::where('nama_barang', $request->nama_barang)->update([

                        'stock' => $stok->stock - $penambahan,
                        'total_harga_beli' => ($stok->stock - $penambahan) * $hrgSatuan->harga_satuan_beli,
                        'total_harga_jual' => ($stok->stock - $penambahan) * $totaljual->harga_satuan_jual

                    ]);


                }else if($request->jumlah < $penjualan->jumlah) {

                    $pengurangan = $penjualan->jumlah - $request->jumlah;

                    Barang::where('nama_barang', $request->nama_barang)->update([

                        'stock' => $stok->stock + $pengurangan,
                        'total_harga_beli' => ($stok->stock + $pengurangan) * $hrgSatuan->harga_satuan_beli,
                        'total_harga_jual' => ($stok->stock + $pengurangan) * $totaljual->harga_satuan_jual

                    ]);

                }

        }else{

            if($request->jumlah > $penjualan->jumlah){

                $penambahan = $request->jumlah - $penjualan->jumlah;

                Barang::where('nama_barang', $request->nama_barang)->update([

                    'stock' => $stok->stock - $penambahan,
                    'total_harga_beli' => ($stok->stock - $penambahan) * $hrgSatuan->harga_satuan_beli,
                    'total_harga_jual' => ($stok->stock - $penambahan) * $totaljual->harga_satuan_jual

                ]);


            }else if($request->jumlah < $penjualan->jumlah) {

                $pengurangan = $penjualan->jumlah - $request->jumlah;

                Barang::where('nama_barang', $request->nama_barang)->update([

                    'stock' => $stok->stock + $pengurangan,
                    'total_harga_beli' => ($stok->stock + $pengurangan) * $hrgSatuan->harga_satuan_beli,
                    'total_harga_jual' => ($stok->stock + $pengurangan) * $totaljual->harga_satuan_jual

                ]);

            }

        }

        Penjualan::where('id', $penjualan->id)->update([

            'nama_pelanggan' => $request->nama_pelanggan,
            'nama_barang' => $request->nama_barang,
            'tanggal' => $newDate,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'total' => $request->total

        ]);

        return redirect('/penjualan')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        $stok = DB::table('barang')
                ->select('stock')
                ->where('nama_barang','=', $penjualan->nama_barang)
                ->first();

        $satuanjual = DB::table('barang')
        ->select('harga_satuan_jual')
        ->where('nama_barang','=', $penjualan->nama_barang)
        ->first();

        $satuanbeli = DB::table('barang')
        ->select('harga_satuan_beli')
        ->where('nama_barang','=', $penjualan->nama_barang)
        ->first();

            Barang::where('nama_barang', $penjualan->nama_barang)->update([
                'stock' => $stok->stock + $penjualan->jumlah,
                'total_harga_beli' =>  ($stok->stock + $penjualan->jumlah) * $satuanbeli->harga_satuan_beli,
                'total_harga_jual' => ($stok->stock + $penjualan->jumlah) * $satuanjual->harga_satuan_jual
            ]);

        Penjualan::destroy($penjualan->id);

        return redirect('/penjualan')->with('status', 'Data Berhasil Dihapus!');
    }

    public function listBarang(Request $request){

        $request->validate([

            'nama_pelanggan' => 'required',
            'nama_barang' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'total' => 'required'
        ]);

        $daftarBarang =  $request->all();

        $listBarang = [];

        $stok = DB::table('barang')
                ->select('stock')
                ->where('nama_barang','=', $daftarBarang['nama_barang'])
                ->first();

        $minusVal = $stok->stock - $daftarBarang['jumlah'];
        if($minusVal < 0){

            return redirect('/penjualan/input')->with('failed', 'Data tidak berhasil masuk list, karena stok barang tidak mencukupi! kekurangan data '.$minusVal);
        }else{

            if(session()->has('data_brg_jual')){

                $dataBarang = session('data_brg_jual');

                foreach ($dataBarang as $item) {

                        array_push($listBarang, $item);

                }

                array_push($listBarang, $daftarBarang);
            }else{
                array_push($listBarang, $daftarBarang);
            }

        }


        session(['data_brg_jual' => $listBarang]);
        // dd($listBarang);

        return redirect('/penjualan/input');
    }

    public function dataBarang(Request $request){

        if($request->ajax()){

            $barang = Barang::all();

            return response()->json($barang);
        }
    }

    public function getHarga(Request $request){

        if($request->ajax()){

            $namaBarang = $request->get('nama_barang');

            $harga = DB::table('barang')
            ->select('harga_satuan_jual','satuan','stock')
            ->where('nama_barang','=', $namaBarang)
            ->first();

            $hargaJual = $harga->harga_satuan_jual;
            $satuan = $harga->satuan;
            $stock = $harga->stock;

            return ['hargaJual' => $hargaJual, 'satuan' => $satuan ,'stok' => $stock];
        }
    }

    public function dataPelanggan(Request $request){

        if($request->ajax()){

            $pelanggan = Pelanggan::all();

            return response()->json($pelanggan);
        }
    }

    public function deleteBarang($namabarang)
    {

        $dataBarang = session('data_brg_jual');

        $barangUpdate = [];

        foreach ($dataBarang as $item) {
            if ($namabarang == $item['nama_barang']) {
                unset($item);
            } else {
                array_push($barangUpdate, $item);
            }
        }

        session(['data_brg_jual' => $barangUpdate]);

        return redirect('/penjualan/input');
    }

    public function deleteListAll(){
        session()->forget('data_brg_jual');
        return redirect('/penjualan/input');
    }

    public function cetak_pdf(){

        $penjualan = session('filterVal');

        $pdf = PDF::loadview('admin.tabel_transaksi.penjualan.cetak', ['penjualan' => $penjualan]);

        return $pdf->stream();
    }

    public function getFilter(Request $request){

        $query = DB::table('penjualan')
                    ->where('id', 'like', '%'. $request->filter.'%')
                    ->orWhere('nama_pelanggan', 'like', '%'. $request->filter.'%')
                    ->orWhere('nama_barang', 'like', '%'. $request->filter.'%')
                    ->orWhere('tanggal', 'like', '%'. $request->filter.'%')
                    ->orWhere('jumlah', 'like', '%'. $request->filter.'%')
                    ->orWhere('satuan', 'like', '%'. $request->filter.'%')
                    ->orWhere('harga_satuan', 'like', '%'. $request->filter.'%')
                    ->orWhere('total', 'like', '%'. $request->filter.'%')
                    ->get();

        $url = "http://127.0.0.1:8000/penjualan/cetak-pdf";
        $urlin = "/penjualan";
        session(['filterVal' => $query]);
        echo "<script>window.open('".$url."', '_blank')
        setTimeout(function(){location.href='".$urlin."'; }, 2000);
        </script>";

    }
}
