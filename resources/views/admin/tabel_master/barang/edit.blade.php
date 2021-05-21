@extends('template_admin.layout')


@section('tabel', 'active show')
@section('master', 'active show')
@section('barang', 'active show')
@section('content')



<div class="content">

    <h1>Edit Tabel Barang</h1>


    <a href="{{ '/barang' }}" type="button" class="mb-1 btn btn-primary mt-5 text-white">
        <i class=" mdi mdi-arrow-left-bold mr-1"></i>
        Kembali </a>

    <div class="row mt-3">

        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Form Edit Barang</h2>
                </div>
                <div class="card-body">
                    <form action="{{ 'update' }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Nama Barang</label>
                                <input type="text"
                                    class="form-control barang @error('nama_barang') is-invalid @enderror"
                                    autocomplete="off" value="{{ $barang->nama_barang}}" name="nama_barang">
                                @error('nama_barang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-ms-4">
                                <label for="validationServer03">Stok</label>
                                <div class="input-group ">
                                    <input type="number" class="form-control stok @error('stock') is-invalid @enderror"
                                        autocomplete="off" min="0" value="{{ $barang->stock }}" name="stock">
                                    @error('stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-append position-relative">
                                        <select name="satuan" class="form-control" id="satuan">
                                            <option value="{{ $barang->satuan }}">{{ $barang->satuan }}</option>
                                            @foreach ($satuan as $item)
                                            <option value="{{ $item->nama_satuan }}">{{ $item->nama_satuan }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Harga Beli/satuan</label>
                                <input type="number" min="0"
                                    class="form-control harga_beli @error('harga_satuan_beli') is-invalid @enderror"
                                    id="validationServer05" value="{{ $barang->harga_satuan_beli }}"
                                    name="harga_satuan_beli">
                                @error('harga_satuan_beli')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Total Harga Beli</label>
                                <input type="number"
                                    class="form-control total_beli @error('total_harga_beli') is-invalid @enderror"" id="
                                    total_harga_beli" name="total_harga_beli" value="{{ $barang->total_harga_beli }}"
                                    required readonly>
                                @error('total_harga_beli')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Harga Jual/satuan</label>
                                <input type="number" min="0"
                                    class="form-control harga_jual @error('harga_satuan_jual') is-invalid @enderror"
                                    id="validationServer05" value="{{ $barang->harga_satuan_jual }}"
                                    name="harga_satuan_jual">
                                @error('harga_satuan_jual')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Total Harga Jual</label>
                                <input type="number"
                                    class="form-control total_jual @error('total_harga_jual') is-invalid @enderror"
                                    id="" value="{{ $barang->total_harga_jual }}" name="total_harga_jual" required
                                    readonly>
                                @error('total_harga_jual')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-8 mb-3">
                                <label for="">Gambar Barang</label><br />
                                <input type="file" name="gambar_barang"
                                    class="form-control @error('gambar_barang') is-invalid @enderror">
                                @error('gambar_barang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <img width="150px" src="{{ url('/data_images/' . $barang->gambar_barang) }}"
                                    alt="tidak ada gambar">
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
@section('script')

<script>
    $(document).ready(function () {
        // var now = new Date();

        // var day = ("0" + now.getDate()).slice(-2);
        // var month = ("0" + (now.getMonth() + 1)).slice(-2);

        // var today = now.getFullYear() + "-" + (month) + "-" + (day);

        // $('.datePicker').val(today);

        $('.harga_beli').keyup(function () {
            let stok = $('.stok').val();
            let harga = $('.harga_beli').val();

            let total = stok * harga;

            $('.total_beli').val(total);
        })

        $('.harga_jual').keyup(function () {
            let stok = $('.stok').val();
            let harga = $('.harga_jual').val();

            let total = stok * harga;

            $('.total_jual').val(total);
        })

        $('.stok').keyup(function () {
            let stok = $('.stok').val();
            let harga_beli = $('.harga_beli').val();
            let harga_jual = $('.harga_jual').val();

            let total_beli = stok * harga_beli;
            let total_jual = stok * harga_jual;

            $('.total_beli').val(total_beli);
            $('.total_jual').val(total_jual);
        })

    });

</script>
@endsection
