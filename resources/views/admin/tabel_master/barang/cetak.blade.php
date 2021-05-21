<!DOCTYPE html>
<html>

<head>
    <title>Dokumen</title>
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
        <h5>Data Barang</h4>
    </center>

    <table class='table table-bordered'>
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
            </tr>
        </thead>
        <tbody>

            @foreach($barang as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{$p->nama_barang}}</td>
                <td>{{$p->stock}}</td>
                <td>{{$p->satuan}}</td>
                <td>{{$p->harga_satuan_beli}}</td>
                <td>{{$p->harga_satuan_jual}}</td>
                <td>{{$p->total_harga_beli}}</td>
                <td>{{$p->total_harga_jual}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
