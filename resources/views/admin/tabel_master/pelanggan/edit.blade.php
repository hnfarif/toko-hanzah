@extends('template_admin.layout')


@section('tabel', 'active show')
@section('master', 'active show')
@section('pelanggan', 'active show')
@section('content')



<div class="content">

    <h1>Edit Tabel Pelanggan</h1>


    <a href="{{ '/pelanggan' }}" type="button" class="mb-1 btn btn-primary mt-5 text-white">
        <i class=" mdi mdi-arrow-left-bold mr-1"></i>
        Kembali </a>

    <div class="row mt-3">

        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Form Edit Pelanggan</h2>
                </div>
                <div class="card-body">
                    <form action="{{ 'update' }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Nama Pelanggan</label>
                                <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                    autocomplete="off" value="{{ $pelanggan->nama_pelanggan }}" name="nama_pelanggan">
                                @error('nama_pelanggan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    autocomplete="off" value="{{ $pelanggan->alamat }}" name="alamat">
                                @error('alamat')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <input class="btn btn-primary" type="submit" value="Ubah">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
