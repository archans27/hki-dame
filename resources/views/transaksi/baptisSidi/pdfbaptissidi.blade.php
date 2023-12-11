<html>
<head>
    <title>Daftar Baptis/Sidi</title>
</head>
<body>
    <h1>Daftar Baptis/Sidi</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Kepala Keluarga</th>
                <th>Sektor</th>
                <th>Tanggal Baptis/Sidi</th>
                <th>Tanggal Input</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($baptisSidis as $baptisSidi)
                <tr>
                    <td>{{ $baptisSidi->kepala_keluarga }}</td>
                    <td>{{ $baptisSidi->sektor_id }}</td>
                    <td>{{ $baptisSidi->tanggal }}</td>
                    <td>{{ $baptisSidi->created_at }}</td>
                    <td>{{ $baptisSidi->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
