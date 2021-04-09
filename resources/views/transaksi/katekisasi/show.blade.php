<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Katekisasi') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/katekisasi')"/>
                <form action="{{url('/katekisasi/'.$katekisasi->id.'/edit')}}" class="float-right">
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
                            <p class="text-md font-bold text-blue-500">Nama lengkap</p><p>{{$katekisasi->nama}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tanggal lahir</p><p>{{date("d-m-Y",strToTime($katekisasi->tanggal_lahir))}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Jenis kelamin</p><p>{{$katekisasi->jenis_kelamin}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Pekerjaan</p><p>{{$katekisasi->pekerjaan}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Alamat</p><p>{{$katekisasi->alamat_rumah}}</p><br/>
                        </div>
                        <div>
                            <p class="text-md font-bold text-blue-500">Nomor anggota</p><p>{{$katekisasi->no_anggota}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tempat lahir</p><p>{{$katekisasi->tempat_lahir}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Golongan darah</p><p>{{$katekisasi->golongan_darah}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Pendidikan</p><p>{{$katekisasi->pendidikan}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tanggal menjadi anggota</p><p>{{date("d-m-Y",strToTime($katekisasi->tanggal_anggota))}}</p><br/>
                        </div>
                    
                    </div>
                </fieldset>
                <hr class="border mb-5" />
                <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                    <legend class="px-2 text-lg">Data Katekisasi:</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-md font-bold text-blue-500">Tanggal</p><p>{{date("d-m-Y",strToTime($katekisasi->tanggal))}}</p><br/>
                            @php $status = $katekisasi->status == 'L' ? 'Lajang': 'Mau Menikah';@endphp
                            <p class="text-md font-bold text-blue-500">Status</p><p>{{$status}}</p><br/>
                        </div>                    
                        <div>
                            <p class="text-md font-bold text-blue-500">Hobi</p><p>{{$katekisasi->hobi}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Cita-cita</p><p>{{$katekisasi->cita}}</p><br/>
                        </div>
                    </div>
                </fieldset>
                <div class="clear-both">&nbsp;</div>
                @if ($katekisasi->temporary)
                    <span class="bg-red-500 border-red-600 p-1.5 rounded border-solid font-bold text-white">Tidak Terverifikasi</span>
                @else
                    <span class="bg-green-400 border-green-600 p-1.5 rounded border-solid font-bold text-white">Terverifikasi</span>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
