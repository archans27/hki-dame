<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jemaat Meninggal') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/meninggal')"/>
                <form action="{{url('/meninggal/'.$meninggal->id.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>

                <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                    <legend class="px-2 text-lg">Data Utama Jemaat:</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-md font-bold text-blue-500">Nama lengkap</p><p>{{$meninggal->nama}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tanggal lahir</p><p>{{date("d-m-Y",strToTime($meninggal->tanggal_lahir))}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Jenis kelamin</p><p>{{$meninggal->jenis_kelamin}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Pekerjaan</p><p>{{$meninggal->pekerjaan}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Alamat</p><p>{{$meninggal->alamat_rumah}}</p><br/>
                        </div>
                        <div>
                            <p class="text-md font-bold text-blue-500">Nomor anggota</p><p>{{$meninggal->no_anggota}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tempat lahir</p><p>{{$meninggal->tempat_lahir}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Golongan darah</p><p>{{$meninggal->golongan_darah}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Pendidikan</p><p>{{$meninggal->pendidikan}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tanggal menjadi anggota</p><p>{{date("d-m-Y",strToTime($meninggal->tanggal_anggota))}}</p><br/>
                        </div>
                    
                    </div>
                </fieldset>
                <hr class="border mb-5" />
                <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                    <legend class="px-2 text-lg">Data Meninggal:</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-md font-bold text-blue-500">Tanggal</p><p>{{date("d-m-Y",strToTime($meninggal->tanggal))}}</p><br/>
                            @php 
                              $diff = abs(strtotime($meninggal->tanggal) - strtotime($meninggal->tanggal_lahir));
                              $years = floor($diff / (365*60*60*24));
                            @endphp
                            <p class="text-md font-bold text-blue-500">Tempat</p><p>{{$meninggal->tempat}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Keterangan</p><p>{{$meninggal->keterangan}}</p><br/>
                        </div>                    
                        <div>
                            <p class="text-md font-bold text-blue-500">Umur</p><p>{{$years}} tahun</p><br/>
                            <p class="text-md font-bold text-blue-500">Dimakamkan di</p><p>{{$meninggal->dimakamkan_di}}</p><br/>
                        </div>
                    </div>
                </fieldset>
                <div class="clear-both">&nbsp;</div>
                @if ($meninggal->temporary)
                    <span class="bg-red-500 border-red-600 p-1.5 rounded border-solid font-bold text-white">Tidak Terverifikasi</span>
                @else
                    <span class="bg-green-400 border-green-600 p-1.5 rounded border-solid font-bold text-white">Terverifikasi</span>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
