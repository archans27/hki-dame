<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            #jemaat-table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            #jemaat-table td, #jemaat-table th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            #jemaat-table tr:nth-child(even){background-color: #f2f2f2;}

            #jemaat-table tr:hover {background-color: #ddd;}

            #jemaat-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        </style>
        
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        <h1>Anggota Jemaat</h1>
        <p>yang berulang tahun pada bulan {{ date('F', strtotime("1970-$filter->month-01")) }} </p>
        <div>    
            <table id="jemaat-table">
                <tr>
                    <th>No</th>
                    <th>Sektor</th>
                    <th>Nama Bapak</th>
                    <th>Alamat Rumah</th>
                </tr>
                @php $no=1; $hubungan = 'Suami';@endphp
                @foreach ($jemaats as $jemaat)
                @if($jemaat->hubungan != $hubungan)
                    @php $hubungan = $jemaat->hubungan; $nama_hubungan = $hubungan == 'Istri' ? 'Ibu' : $hubungan; @endphp
                <tr><td colspan="4"></td></tr>
                <tr>
                    <th>No</th>
                    <th>Sektor</th>
                    <th>Nama {{ $nama_hubungan }}</th>
                    <th>Alamat Rumah</th>
                </tr>
                @endif
                <tr>
                    <td>{{ $no }}.</td>
                    <td>{{ $jemaat->sektor_id }}</td>
                    <td><a href="{{url('/jemaat/'.$jemaat->id)}}">{{$jemaat->nama}}</a> </br> ({{date("d-m-Y",strToTime($jemaat->tanggal_lahir))}})</td>
                    <td>{{ $jemaat->alamat_rumah }}
                    </td>
                </tr>
                @php $no++; @endphp
                @endforeach
            </table>
        </div>
        <br>
        <div style="text-align:center;">
            <h2>Pendeta Resort, BPH, dan Parhalado</h2>
            <h2>HKI Dame Resort Bandung</h2>
            <h2>Mengucapkan</h2>
            <br>
            <h2>Selamat Ulang Tahun</h2>
            <h2>Tuhan Yesus memberkati</h2>
        </div>
    </body>
</html>