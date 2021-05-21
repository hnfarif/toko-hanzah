<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('admin.tabel_master.pelanggan.tabel', compact('pelanggan'));
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

            'nama_pelanggan' => 'required',
            'alamat' => 'required'

        ]);

        Pelanggan::create($request->all());

        return redirect('/pelanggan')->with('status', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('admin.tabel_master.pelanggan.input');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {

        return view('admin.tabel_master.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        Pelanggan::where('id', $pelanggan->id)->update([

            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat
        ]);
        return redirect('/pelanggan')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        Pelanggan::destroy($pelanggan->id);

        return redirect('/pelanggan');
    }

    public function cetak_pdf(){

        $pelanggan = session('filterVal');

        $pdf = PDF::loadview('admin.tabel_master.pelanggan.cetak', ['pelanggan' => $pelanggan]);

        return $pdf->stream();
    }

    public function getFilter(Request $request){

        $query = DB::table('pelanggan')
                    ->where('id', 'like', '%'. $request->filter.'%')
                    ->orWhere('nama_pelanggan', 'like', '%'. $request->filter.'%')
                    ->orWhere('alamat', 'like', '%'. $request->filter.'%')
                    ->get();

        $url = "http://127.0.0.1:8000/pelanggan/cetak-pdf";
        $urlin = "/pelanggan";
        session(['filterVal' => $query]);
        echo "<script>window.open('".$url."', '_blank')
        setTimeout(function(){location.href='".$urlin."'; }, 2000);
        </script>";

    }
}
