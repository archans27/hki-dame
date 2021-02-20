<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jemaat') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/jemaat')"/>
                <form action="{{url('/jemaat/'.$jemaat->id.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>


                <p class="text-md font-bold text-blue-500">Nama lengkap</p><p>{{$jemaat->nama}}</p><br/>
                <p class="text-md font-bold text-blue-500">Nomor anggota</p><p>{{$jemaat->no_anggota}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tanggak lahir</p><p>{{$jemaat->tempat_lahir}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tempat lahir</p><p>{{$jemaat->tanggal_lahir}}</p><br/>
                <p class="text-md font-bold text-blue-500">Jenis kelamin</p><p>{{$jemaat->jenis_kelamin}}</p><br/>
                <p class="text-md font-bold text-blue-500">Golongan darah</p><p>{{$jemaat->golongan_darah}}</p><br/>
                <p class="text-md font-bold text-blue-500">Nomor telepon</p><p>{{$jemaat->nomor_telepon}}</p><br/>
                <p class="text-md font-bold text-blue-500">Pendidikan</p><p>{{$jemaat->pendidikan}}</p><br/>
                <p class="text-md font-bold text-blue-500">Pekerjaan</p><p>{{$jemaat->pekerjaan}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tanggal menjadi anggota</p><p>{{$jemaat->tanggal_anggota}}</p><br/>
                <p class="text-md font-bold text-blue-500">Status jemaat</p><p>{{$jemaat->hidup ? "Masih Hidup" : "Meninggal Dunia"}}</p><br/>
                {{-- <p class="text-md font-bold text-blue-500">Alamat rumah</p><p>{{$jemaat->alamat_rumah}}</p><br/>
                <p class="text-md font-bold text-blue-500">Status rumah</p><p>{{$jemaat->status_rumah}}</p><br/>
                <p class="text-md font-bold text-blue-500">Sektor</p><p>{{$jemaat->sektor_id}}</p><br/> --}}
            </div>
        </div>
    </div>
</x-app-layout>
