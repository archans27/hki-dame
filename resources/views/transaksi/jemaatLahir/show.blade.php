<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kelahiran/Angkat Anak') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/jemaatLahir')"/>
                <form action="{{url('/jemaatLahir/'.$jemaatLahir->idJemaatLahir.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>

                {{-- <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                    <legend class="px-2 text-lg">Data utama jemaat:</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-md font-bold text-blue-500">Nama Kepala Keluarga</p><p>{{$jemaatLahir->kepala_keluarga}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Alamat Orang Tua</p><p>{{$jemaatLahir->alamat_rumah}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Nama Lengkap</p><p>{{$jemaatLahir->nama}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tanggal Lahir</p><p>{{$jemaatLahir->tanggal_lahir}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tempat Lahir</p><p>{{$jemaatLahir->tempat_lahir}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Jenis Kelamin</p><p>{{$jemaatLahir->jenis_kelamin}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Golongan darah</p><p>{{$jemaatLahir->golongan_darah}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Status Anak</p><p>{{$jemaatLahir->status_anak}}</p><br/>

                        </div>
                    
                    </div>
                </fieldset> --}}
                <hr class="border mb-5" />
                <div class="grid grid-cols-2 gap-4">
                    <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                        <legend class="px-2 text-lg">Data Jemaat Baru:</legend>
                        <p class="text-md font-bold text-blue-500">Nama Kepala Keluarga</p><p>{{$jemaatLahir->kepala_keluarga}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Alamat Orang Tua</p><p>{{$jemaatLahir->alamat_rumah}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Nama Lengkap</p><p>{{$jemaatLahir->nama}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Tanggal Lahir</p><p>{{date("d-m-Y",strToTime($jemaatLahir->tanggal_lahir))}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Lahir Pada Pukul</p><p>{{$jemaatLahir->jam_lahir}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Tempat Lahir</p><p>{{$jemaatLahir->tempat_lahir}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Jenis Kelamin</p><p>{{$jemaatLahir->jenis_kelamin}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Golongan darah</p><p>{{$jemaatLahir->golongan_darah}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Status Anak</p><p>{{$jemaatLahir->status_anak}}</p><br/>
                    </fieldset>
                    <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                        <legend class="px-2 text-lg">Ucapan Syukur:</legend>
                        <p class="text-md font-bold text-blue-500">Ucapan Syukur Kepada Gereja:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['gereja'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan Syukur Kepada Majelis:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['majelis'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan Syukur Kepada Pendeta:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['pendeta'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan Syukur Kepada Pendeta Diperbantukan:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['pendeta_diperbantukan'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan Syukur Kepada Guru Huria:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['guru_huria'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan Syukur Untuk Lain-lain:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['lain_lain'])),3)))}},-</p><br/>
                    </fieldset>
                </div>
                <div class="clear-both my-5"></div>
                @if ($jemaatLahir->temporary)
                    <span class="bg-red-500 border-red-600 p-1.5 rounded border-solid font-bold text-white">Tidak Terverifikasi</span>
                @else
                    <span class="bg-green-400 border-green-600 p-1.5 rounded border-solid font-bold text-white">Terverifikasi</span>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
