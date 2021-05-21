<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('admin.tabel_master.barang.tabel', compact('barang'));
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
        $request->validate([

            'nama_barang' => 'required',
            'stock' => 'required',
            'satuan' => 'required',
            'harga_barang' => 'required',
            'total' => 'required',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg'

        ]);

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $name = $file->getClientOriginalName();
            $file->move(\base_path() . "/public/data_images", $name);

            $barang = new Barang();
            $barang->nama_barang = $request->nama_barang;
            $barang->stock = $request->stock;
            $barang->satuan = $request->satuan;
            $barang->harga_barang = $request->harga_barang;
            $barang->total = $request->total;
            $barang->gambar_barang = $name;

            $barang->save();
        }

        return redirect('/barang')->with('status', 'Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return view('admin.tabel_master.barang.input');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $satuan = DB::table('satuan')
            ->select('nama_satuan')
            ->where('nama_satuan','!=', $barang->satuan)
            ->get();

        return view('admin.tabel_master.barang.edit', ['barang' => $barang, 'satuan' => $satuan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $name = $file->getClientOriginalName();
            $file->move(\base_path() . "/public/data_images", $name);

            Barang::where('id', $barang->id)->update([

                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'satuan' => $request->satuan ?? '',
                'harga_satuan_beli' => $request->harga_satuan_beli,
                'harga_satuan_jual' => $request->harga_satuan_jual,
                'total_harga_beli' => $request->total_harga_beli,
                'total_harga_jual' => $request->total_harga_jual,
                'gambar_barang' => $name
            ]);

            Pembelian::where('nama_barang', $barang->nama_barang)->update([

                'nama_barang' => $request->nama_barang
            ]);

        } else {
            Barang::where('id', $barang->id)->update([

                'nama_barang' => $request->nama_barang,
                'stock' => $request->stock,
                'satuan' => $request->satuan ?? '',
                'harga_satuan_beli' => $request->harga_satuan_beli,
                'harga_satuan_jual' => $request->harga_satuan_jual,
                'total_harga_beli' => $request->total_harga_beli,
                'total_harga_jual' => $request->total_harga_jual
            ]);

            Pembelian::where('nama_barang', $barang->nama_barang)->update([

                'nama_barang' => $request->nama_barang
            ]);
        }

        return redirect('/barang')->with('status', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);

        return redirect('/barang')->with('status', 'Data Berhasil Dihapus!');
    }

    public function cetak_pdf(){

        $barang = session('filterVal');

        $pdf = PDF::loadview('admin.tabel_master.barang.cetak', ['barang' => $barang]);

        return $pdf->stream();
    }

    public function getFilter(Request $request){

        $query = DB::table('barang')
                    ->where('id', 'like', '%'. $request->filter.'%')
                    ->orWhere('nama_barang', 'like', '%'. $request->filter.'%')
                    ->orWhere('stock', 'like', '%'. $request->filter.'%')
                    ->orWhere('harga_satuan_beli', 'like', '%'. $request->filter.'%')
                    ->orWhere('harga_satuan_jual', 'like', '%'. $request->filter.'%')
                    ->orWhere('total_harga_beli', 'like', '%'. $request->filter.'%')
                    ->orWhere('total_harga_jual', 'like', '%'. $request->filter.'%')
                    ->get();

        $url = "http://127.0.0.1:8000/barang/cetak-pdf";
        $urlin = "/barang";
        session(['filterVal' => $query]);
        echo "<script>window.open('".$url."', '_blank')
        setTimeout(function(){location.href='".$urlin."'; }, 2000);
        </script>";

    }
}
