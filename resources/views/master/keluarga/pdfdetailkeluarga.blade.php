<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Keluarga</title>
    <style>
        /* Add any custom styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Detail Keluarga</h1>

    <table>
        <tr>
            <th>Nama Kepala Keluarga</th>
            <td>{{ $keluarga->kepala_keluarga }}</td>
        </tr>
        <tr>
            <th>No. Keluarga</th>
            <td>{{ $keluarga->no_keluarga }}</td>
        </tr>
        <tr>
            <th>Sektor</th>
            <td>{{ $keluarga->nama_sektor }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $keluarga->alamat_rumah }}</td>
        </tr>
        <tr>
            <th>Status Rumah</th>
            <td>{{ $keluarga->status_rumah }}</td>
        </tr>
    </table>

    <h2>Anggota Keluarga</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Anggota Keluarga</th>
                <th>Hubungan dalam Keluarga</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familyMembers as $member)
                <tr>
                    <td>{{ $member->nama_anggota_keluarga }}</td>
                    <td>{{ $member->hubungan }}</td>
                    <td>{{ $member->jenis_kelamin }}</td>
                    <td>{{ $member->tanggal_lahir }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
