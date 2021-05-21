@extends('template_admin.layout')


@section('tabel', 'active show')
@section('transaksi', 'active show')
@section('penjualan', 'active show')
@section('content')

<style>
    .ui-menu .ui-menu-item a {
        background: red;
        height: 10px;
        font-size: 8px;
    }

</style>

<div class="content">

    <h1>Input Tabel Penjualan</h1>


    <a href="{{ '/penjualan' }}" type="button" class="mb-1 btn btn-primary mt-5 text-white">
        <i class=" mdi mdi-arrow-left-bold mr-1"></i>
        Kembali </a>

    <div class="row mt-3">

        <div class="col-md-12">
            @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
            @endif
        </div>
        <div class="col-5">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Form Input Penjualan</h2>
                </div>
                <div class="card-body">
                    <form action="{{ '/penjualan/input/list' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3 ui-menu ui-menu-item">
                                <label>Nama Pelanggan</label>
                                <input type="text"
                                    class="form-control barang @error('nama_pelanggan') is-invalid @enderror"
                                    autocomplete="off" value="{{ $pelanggan }}" name="nama_pelanggan"
                                    id="nama_pelanggan">
                                @error('nama_pelanggan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3 ui-menu ui-menu-item">
                                <label>Nama Barang</label>
                                <input type="text"
                                    class="form-control nm-brg @error('nama_barang') is-invalid @enderror"
                                    autocomplete="off" value="{{ old('nama_barang') }}" name="nama_barang"
                                    id="nama_barang">
                                @error('nama_barang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3" id="divStok" hidden="hidden">
                                <label id="jmlStok"></label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Tanggal</label>
                                <input type="date"
                                    class="form-control datePicker @error('tanggal') is-invalid @enderror"
                                    autocomplete="off" value="{{ old('tanggal') }}" name="tanggal">
                                @error('tanggal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-ms-4">
                                <label for="validationServer03">Jumlah</label>
                                <div class="input-group ">
                                    <input type="number" class="form-control stok @error('jumlah') is-invalid @enderror"
                                        autocomplete="off" min="0" value="{{ old('jumlah') }}" name="jumlah">
                                    @error('stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-append position-relative">
                                        <select name="satuan" class="form-control" id="s_satuan">
                                            @foreach ($satuan as $item)

                                            <option value="{{ $item->nama_satuan }}">{{ $item->nama_satuan }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Harga/satuan</label>
                                <input type="number" min="0"
                                    class="form-control harga @error('harga_satuan') is-invalid @enderror" id="harga"
                                    value="{{ old('harga_satuan') }}" name="harga_satuan" readonly>
                                @error('harga_satuan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Total Harga</label>
                                <input type="number"
                                    class="form-control total @error('total') is-invalid @enderror"" id="
                                    validationServer05" required readonly name="total">
                                @error('total')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <input class="btn btn-primary" type="submit" value="Tambah">
                    </form>
                </div>
            </div>

        </div>
        <div class="col-7">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between">
                    <h2>Daftar Barang Jual</h2>
                    <form action="{{ '/penjualan/deleteListAll' }}" method="get">

                        <button class="btn btn-outline-primary btn-sm text-uppercase">
                            <i class=" mdi mdi-delete-sweep mr-1"></i>hapus semua
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="basic-data-table">
                        <table class="table table-bordered nowrap display">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Tanggal Jual</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataBarang as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td class="text-dark">{{ $item['nama_pelanggan'] }}</td>
                                    <td class="text-dark">{{ $item['nama_barang'] }}</td>
                                    <td class="text-dark">{{ $item['tanggal'] }}</td>
                                    <td class="text-dark">{{ $item['jumlah'] }}</td>
                                    <td class="text-dark">{{ $item['satuan'] }}</td>
                                    <td class="text-dark">{{ $item['harga_satuan'] }}</td>
                                    <td class="text-dark">{{ $item['total'] }}</td>
                                    <td class="p-3"><a href="{{ 'input/deletelist/'.$item['nama_barang'] }}"
                                            type="button" class="btn btn-danger p-2">
                                            X
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Total Harga : Rp{{ $total }}</h2>
                    <form action="{{ '/penjualan/input/store' }}" method="post" class="ml-auto">
                        @csrf
                        <input class="btn btn-primary" name="input" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {


        // var now = new Date();

        // var day = ("0" + now.getDate()).slice(-2);
        // var month = ("0" + (now.getMonth() + 1)).slice(-2);

        // var today = now.getFullYear() + "-" + (month) + "-" + (day);

        // $('.datePicker').val(today);


        $('.harga').keyup(function () {
            let stok = $('.stok').val();
            let harga = $('.harga').val();

            let total = stok * harga;

            $('.total').val(total);
        })

        $('.stok').keyup(function () {
            let stok = $('.stok').val();
            let harga = $('.harga').val();

            let total = stok * harga;

            $('.total').val(total);
        })

        var barang = [];
        var pelanggan = [];

        $.ajax({

            url: '/penjualan/input/searchbarang',
            method: 'GET',
            async: false,
            success: function (data) {
                data.forEach(element => {
                    barang.push(element['nama_barang']);
                });
            }
        });

        $('#nama_barang').autocomplete({

            source: barang
        });

        $.ajax({

            url: '/penjualan/input/searchpelanggan',
            method: 'GET',
            async: false,
            success: function (data) {
                data.forEach(element => {
                    pelanggan.push(element['nama_pelanggan']);
                });
            }
        });

        $('#nama_pelanggan').autocomplete({

            source: pelanggan
        });

        $(".nm-brg").change(function () {

            let namaBarang = $('.nm-brg').val();
            $("#divStok").removeAttr('hidden');
            $.ajax({

                url: '/penjualan/input/getHarga',
                method: 'GET',
                async: false,
                data: {
                    'nama_barang': namaBarang
                },
                success: function (data) {
                    $("#harga").val(data.hargaJual);
                    $("#s_satuan").val(data.satuan).change();
                    $("#jmlStok").text("Stok Barang : " + data.stok);
                }
            });
        });








    });

</script>
@endsection
