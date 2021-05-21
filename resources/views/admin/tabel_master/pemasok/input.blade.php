@extends('template_admin.layout')


@section('tabel', 'active show')
@section('master', 'active show')
@section('pemasok', 'active show')
@section('content')



<div class="content">

    <h1>Input Tabel Pemasok</h1>


    <a href="{{ '/pemasok' }}" type="button" class="mb-1 btn btn-primary mt-5 text-white">
        <i class=" mdi mdi-arrow-left-bold mr-1"></i>
        Kembali </a>

    <div class="row mt-3">

        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Form Input Pemasok</h2>
                </div>
                <div class="card-body">
                    <form action="{{ 'input/store' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Nama Pemasok</label>
                                <input type="text" class="form-control @error('nama_pemasok') is-invalid @enderror"
                                    autocomplete="off" value="{{ old('nama_pemasok') }}" name="nama_pemasok">
                                @error('nama_barang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Alamat Pemasok</label>
                                <input type="text" class="form-control @error('alamat_pemasok') is-invalid @enderror"
                                    autocomplete="off" value="{{ old('alamat_pemasok') }}" name="alamat_pemasok">
                                @error('alamat_pemasok')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>No Handphone</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    autocomplete="off" value="{{ old('no_hp') }}" name="no_hp">
                                @error('no_hp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <input class="btn btn-primary" type="submit" value="Submit">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
