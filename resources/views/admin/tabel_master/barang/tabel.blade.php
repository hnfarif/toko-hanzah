@extends('template_admin.layout')


@section('tabel', 'active show')
@section('master', 'active show')
@section('barang', 'active show')
@section('content')

<div class="content">

    <h1>Tabel Barang</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/admin/dashboard">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                Tabel
            </li>
            <li class="breadcrumb-item">
                Tabel Master
            </li>
            <li class="breadcrumb-item" aria-current="page">Tabel Barang</li>
        </ol>
    </nav>

    <div class="row mt-3">
        <div class="col-12">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <!-- Recent Order Table -->
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Table Barang</h2>
                    <form action="{{ '/barang/getFilter' }}" method="POST">
                        @csrf
                        <input type="text" id="fil" name="filter" hidden="hidden">
                        <button class="btn btn-outline-primary btn-sm text-uppercase" type="submit">
                            <i class=" mdi mdi-printer mr-1"></i>print
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="basic-data-table">
                        <table id="basic-data-table" class="table nowrap example" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga Beli/Satuan</th>
                                    <th>Harga Jual/Satuan</th>
                                    <th>Total Harga Beli</th>
                                    <th>Total Harga Jual</th>
                                    <th>Gambar</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($barang as $item)


                                <tr>
                                    <td class="text-dark"><b>{{ $item->id }}</b></td>
                                    <td class="text-dark"><b>{{ $item->nama_barang }}</b></td>
                                    <td class="text-dark"><b>{{ $item->stock }}</b></td>
                                    <td class="text-dark"><b>{{ $item->satuan }}</b></td>
                                    <td class="text-dark"><b>{{ $item->harga_satuan_beli }}</b></td>
                                    <td class="text-dark"><b>{{ $item->harga_satuan_jual }}</b></td>
                                    <td class="text-dark"><b>{{ $item->total_harga_beli }}</b></td>
                                    <td class="text-dark"><b>{{ $item->total_harga_jual }}</b></td>
                                    <td>
                                        <img width="80px" src="{{ url('/data_images/' . $item->gambar_barang) }}"
                                            alt="">
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                                id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order1">
                                                <li class="dropdown-item">
                                                    <a href="barang/{{ $item->id }}/edit"
                                                        class="btn btn-info text-white">
                                                        <span class="mdi mdi-pencil"></span>
                                                        Ubah
                                                    </a>
                                                </li>
                                                {{-- <li class="dropdown-item">

                                                    <a rel="{{ $item->id }}" href="javascript:"
                                                class="btn btn-danger text-white del ">
                                                <span class="mdi mdi-delete"></span> Hapus
                                                </a>

                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.del').click(function (e) {
            var id = $(this).attr('rel');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                            timer: 3000
                        }).then(() => {
                            window.location.href = "barang/" + id + "/delete"
                        })
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });

        $('.example').on('search.dt', function () {
            var value = $('.dataTables_filter input').val();
            $("#fil").val(value);

            // console.log(value); // <-- the value
        });
    });

</script>
@endsection
