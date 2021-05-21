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
        <h5>Data Pelanggan</h4>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>

            @foreach($pelanggan as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{$p->nama_pelanggan}}</td>
                <td>{{$p->alamat}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
