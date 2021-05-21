@extends('template_admin.layout')


@section('tabel', 'active show')
@section('master', 'active show')
@section('pemasok', 'active show')
@section('content')



<div class="content">

    <h1>Tabel Pemasok</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="/admin/dashboard">
                    <span class="mdi mdi-home"></span>
                </a>
            </li>
            <li class="breadcrumb-item">
                tabel
            </li>
            <li class="breadcrumb-item">
                tabel Master
            </li>
            <li class="breadcrumb-item" aria-current="page">Tabel Pemasok</li>
        </ol>
    </nav>

    <a href="{{ '/pemasok/input' }}" type="button" class="mb-1 btn btn-primary mt-5 text-white">
        <i class=" mdi mdi-plus-box-multiple mr-1"></i>
        Tambah data</a>


    <div class="row mt-3">
        <div class="col-12">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <!-- Recent Order Table -->
            <div class="card card-default">
                <div class="card-header card-header-border-bottom justify-content-between">
                    <h2>Table Pemasok</h2>
                    <form action="{{ '/pemasok/getFilter' }}" method="POST">
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
                                    <th>ID Pemasok</th>
                                    <th>Nama Pemasok</th>
                                    <th>Alamat</th>
                                    <th>No Handphone</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($pemasok as $item)


                                <tr>
                                    <td class="text-dark"><b>{{ $item->id }}</b></td>
                                    <td class="text-dark"><b>{{ $item->nama_pemasok }}</b></td>
                                    <td class="text-dark"><b>{{ $item->alamat_pemasok }}</b></td>
                                    <td class="text-dark"><b>{{ $item->no_hp }}</b></td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                                                id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdown-recent-order1">
                                                <li class="dropdown-item">
                                                    <a href="pemasok/{{ $item->id }}/edit"
                                                        class="btn btn-info text-white">
                                                        <span class="mdi mdi-pencil"></span>
                                                        Ubah
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                @empty($item)
                                <tr>
                                    <td colspan="6"> No records found</td>
                                </tr>
                                @endempty
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
                    title: "Apakah kamu yakin?",
                    text: "Ketika dihapus, data tidak bisa dikembalikan",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Data Berhasil Dihapus", {
                            icon: "success",
                            timer: 3000
                        }).then(() => {
                            window.location.href = "pemasok/" + id + "/delete"
                        })
                    } else {
                        swal("Batal Menghapus Data");
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
