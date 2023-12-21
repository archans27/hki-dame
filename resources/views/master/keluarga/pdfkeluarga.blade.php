<!-- resources/views/master/keluarga/pdfkeluarga.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Keluarga</title>
    <style>
        table, th, td {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <h1>Daftar Keluarga</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Kepala Keluarga</th>
                <th>Sektor</th>
                <th>Alamat Rumah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keluargas as $keluarga)
                <tr>
                    <td>{{ $keluarga->nama_jemaat }}</td>
                    <td>{{ $keluarga->nama_sektor }}</td>
                    <td>{{ $keluarga->alamat_keluarga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
