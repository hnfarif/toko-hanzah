<?php

namespace App\Http\Controllers;

use App\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasok = Pemasok::all();

        return view('admin.tabel_master.pemasok.tabel', compact('pemasok'));
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

            'nama_pemasok' => 'required',

        ]);

        $pemasok = new Pemasok();

        $pemasok->nama_pemasok = $request->nama_pemasok;
        $pemasok->alamat_pemasok = $request->alamat_pemasok ?? '';
        $pemasok->no_hp = $request->no_hp ?? '';

        $pemasok->save();

        return redirect('/pemasok')->with('status', 'Data Berhasil Ditambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasok $pemasok)
    {
        return view('admin.tabel_master.pemasok.input');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasok $pemasok)
    {
        return view('admin.tabel_master.pemasok.edit', compact('pemasok'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemasok $pemasok)
    {
        Pemasok::where('id', $pemasok->id)->update([

            'nama_pemasok' => $request->nama_pemasok,
            'alamat_pemasok' => $request->alamat_pemasok,
            'no_hp' => $request->no_hp
        ]);

        return redirect('/pemasok')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasok $pemasok)
    {
        Pemasok::destroy($pemasok->id);

        return redirect('/pemasok')->with('success', 'Data Berhasil Dihapus!');
    }

    public function cetak_pdf(){

        $pemasok = session('filterVal');

        $pdf = PDF::loadview('admin.tabel_master.pemasok.cetak', ['pemasok' => $pemasok]);

        return $pdf->stream();
    }

    public function getFilter(Request $request){

        $query = DB::table('pemasok')
                    ->where('id', 'like', '%'. $request->filter.'%')
                    ->orWhere('nama_pemasok', 'like', '%'. $request->filter.'%')
                    ->orWhere('alamat_pemasok', 'like', '%'. $request->filter.'%')
                    ->orWhere('no_hp', 'like', '%'. $request->filter.'%')
                    ->get();

        $url = "http://127.0.0.1:8000/pemasok/cetak-pdf";
        $urlin = "/pemasok";
        session(['filterVal' => $query]);
        echo "<script>window.open('".$url."', '_blank')
        setTimeout(function(){location.href='".$urlin."'; }, 2000);
        </script>";

    }
}
