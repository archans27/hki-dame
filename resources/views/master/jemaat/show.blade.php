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


                <p class="text-md font-bold text-blue-500">Nama Lengkap</p><p>{{$jemaat->nama}}</p><br/>
                <p class="text-md font-bold text-blue-500">No. Anggota</p><p>{{$jemaat->no_anggota}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tanggal Lahir</p><p>{{$jemaat->tempat_lahir}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tempat Lahir</p><p>{{date("d-m-Y",strToTime($jemaat->tanggal_lahir))}}</p><br/>
                <p class="text-md font-bold text-blue-500">Jenis Kelamin</p><p>{{$jemaat->jenis_kelamin}}</p><br/>
                <p class="text-md font-bold text-blue-500">Golongan Darah</p><p>{{$jemaat->golongan_darah}}</p><br/>
                <p class="text-md font-bold text-blue-500">No. Telepon</p><p>{{$jemaat->nomor_telepon}}</p><br/>
                <p class="text-md font-bold text-blue-500">Pendidikan</p><p>{{$jemaat->pendidikan}}</p><br/>
                <p class="text-md font-bold text-blue-500">Pekerjaan</p><p>{{$jemaat->pekerjaan}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tanggal Menjadi Anggota</p><p>{{date("d-m-Y",strToTime($jemaat->tanggal_anggota))}}</p><br/>
                <p class="text-md font-bold text-blue-500">Status Jemaat</p><p>{{$jemaat->hidup ? "Masih Hidup" : "Meninggal Dunia"}}</p><br/>
                {{-- <p class="text-md font-bold text-blue-500">Alamat Rumah</p><p>{{$jemaat->alamat_rumah}}</p><br/>
                <p class="text-md font-bold text-blue-500">Status Rumah</p><p>{{$jemaat->status_rumah}}</p><br/>
                <p class="text-md font-bold text-blue-500">Sektor</p><p>{{$jemaat->sektor_id}}</p><br/> --}}
            </div>
        </div>
    </div>
</x-app-layout>
