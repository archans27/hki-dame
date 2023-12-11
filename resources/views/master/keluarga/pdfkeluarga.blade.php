<!-- resources/views/master/keluarga/pdfkeluarga.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Keluarga</title>
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
