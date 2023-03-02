<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="font-sans antialiased" id="body">
        <h1>Daftar Jemaat</h1>
        <p class="text-left pb-2">Terdapat {{$jemaats->total()}} hasil dari data jemaat</p>
        <div class="p-6 bg-white border-b border-gray-200">    
            <table class="min-w-full table-auto text-left">
                <thead class="justify-between">
                    <tr class="bg-gray-800 text-white">
                    <th class="px-16 py-2">Nama jemaat</th>
                    <th class="px-16 py-2">Tanggal lahir</th>
                    <th class="px-16 py-2">Jenis kelamin</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200">
                    @foreach ($jemaats as $jemaat)
                        <tr class="bg-white border-4 border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                        <td class="px-16 py-2 flex flex-row text-center cursor-pointer font-bold text-blue-500 hover:text-yellow-500" ><a href="{{url('/jemaat/'.$jemaat->id)}}">{{$jemaat->nama}}</a></td>
                        <td class="px-16 py-2 text-center">{{date("d-m-Y",strToTime($jemaat->tanggal_lahir))}}</td>
                        <td class="px-16 py-2 text-center">{{$jemaat->jenis_kelamin}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>