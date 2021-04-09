<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pindah') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/pindah')"/>
                <form action="{{url('/pindah/'.$pindah->id.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>

                <p class="text-md font-bold text-blue-500">Nama Kepala Keluarga</p><p>{{$keluarga->kepala_keluarga}}</p><br/>
                <p class="text-md font-bold text-blue-500">Alamat</p><p>{{$keluarga->alamat_rumah}}</p><br/>

                <table class="table-auto border mt-5">
                    <thead>
                        <tr class="bg-gray-400 text-gray-800 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left w-5">No.</th>
                            <th class="py-3 px-6 text-left w-40">Nama</th>
                            <th class="py-3 px-6 text-center w-50">Tempat, Tanggal lahir</th>
                            <th class="py-3 px-6 text-center w-40">Jenis Kelamin</th>
                            <th class="py-3 px-6 text-center w-40">Hubungan</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($anggotaKeluargas as $anggotaKeluarga)
                            <tr>
                                <td class="border text-center p-2">{{$i++}}</td>
                                <td class="border text-left p-2">{{$anggotaKeluarga->nama}}</td>
                                <td class="border text-left p-2">{{$anggotaKeluarga->tempat_lahir.', '.$anggotaKeluarga->tanggal_lahir}}</td>
                                <td class="border text-center p-2">{{$anggotaKeluarga->jenis_kelamin}}</td>
                                <td class="border text-center p-2">{{$anggotaKeluarga->hubungan}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <br>
                <p class="text-md font-bold text-blue-500">Mereka bermaksud pindah ke</p><p>{{$pindah->tempat ? $pindah->tempat : '-'}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tanggal</p><p>{{date("d-m-Y",strToTime($pindah->tanggal))}}</p><br/>

                <div class="clear-both">&nbsp;</div>
                @if ($pindah->temporary)
                    <span class="bg-red-500 border-red-600 p-1.5 rounded border-solid font-bold text-white">Tidak Terverifikasi</span>
                @else
                    <span class="bg-green-400 border-green-600 p-1.5 rounded border-solid font-bold text-white">Terverifikasi</span>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
