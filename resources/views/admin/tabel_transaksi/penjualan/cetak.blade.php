<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h5>Laporan Penjualan</h4>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>ID Penjualan</th>
                <th>Nama Pelanggan</th>
                <th>Nama Barang</th>
                <th>Tanggal Jual</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            @foreach($penjualan as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{$p->nama_pelanggan}}</td>
                <td>{{$p->nama_barang}}</td>
                <td>{{$p->tanggal}}</td>
                <td>{{$p->jumlah}}</td>
                <td>{{$p->satuan}}</td>
                <td>{{$p->harga_satuan}}</td>
                <td>{{$p->total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
