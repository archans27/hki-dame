<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jemaat Baru') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/jemaatBaru')"/>
                <form action="{{url('/jemaatBaru/'.$jemaatBaru->idJemaatBaru.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>

                <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                    <legend class="px-2 text-lg">Data utama jemaat:</legend>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-md font-bold text-blue-500">Nama lengkap</p><p>{{$jemaatBaru->nama}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tanggal lahir</p><p>{{date("d-m-Y",strToTime($jemaatBaru->tanggal_lahir))}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Jenis kelamin</p><p>{{$jemaatBaru->jenis_kelamin}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Nomor telepon</p><p>{{$jemaatBaru->nomor_telepon}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Pekerjaan</p><p>{{$jemaatBaru->pekerjaan}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Status jemaat</p><p>{{$jemaatBaru->hidup ? "Masih Hidup" : "Meninggal Dunia"}}</p><br/>
                        </div>
                        <div>
                            <p class="text-md font-bold text-blue-500">Nomor anggota</p><p>{{$jemaatBaru->no_anggota}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tempat lahir</p><p>{{$jemaatBaru->tempat_lahir}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Golongan darah</p><p>{{$jemaatBaru->golongan_darah}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Pendidikan</p><p>{{$jemaatBaru->pendidikan}}</p><br/>
                            <p class="text-md font-bold text-blue-500">Tanggal menjadi anggota</p><p>{{date("d-m-Y",strToTime($jemaatBaru->tanggal_anggota))}}</p><br/>
                        </div>
                    
                    </div>
                </fieldset>
                <hr class="border mb-5" />
                <div class="grid grid-cols-2 gap-4">
                    <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                        <legend class="px-2 text-lg">Data Jemaat Baru:</legend>
                        <p class="text-md font-bold text-blue-500">Melampirakan Copy/Asli</p><p>{{$jemaatBaru->lampiran}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Alamat</p><p>{{$jemaatBaru->alamat_jemaat_baru}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Terakhir sebagai Anggota/Majelis di Gereja:</p><p>{{$jemaatBaru->gereja_terakhir}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Pernah menjadi Anggota/Majelis di Gereja:</p><p>{{$jemaatBaru->gereja_lama_lain}}</p><br/>
                        <p class="text-md font-bold text-blue-500">Bersedia memberikan persembahan tahunan minimal:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($jemaatBaru->persembahan_tahunan)),3)))}},-</p><br/>
                    </fieldset>
                    <fieldset class="border-solid border-blue-500 border-2 px-4 rounded-md">
                        <legend class="px-2 text-lg">Ucapan Syukur:</legend>
                        <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Pendeta:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['pendeta'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Guru Huria:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['guru_huria'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Gereja:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['gereja'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan syukur untuk Majelis:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['majelis'])),3)))}},-</p><br/>
                        <p class="text-md font-bold text-blue-500">Ucapan syukur untuk S. Pengembangan:</p><p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($ucapanSyukur['pengembangan'])),3)))}},-</p><br/>
                    </fieldset>
                </div>
                <div class="clear-both">&nbsp;</div>
                @if ($jemaatBaru->temporary)
                    <span class="bg-red-500 border-red-600 p-1.5 rounded border-solid font-bold text-white">Tidak Terverifikasi</span>
                @else
                    <span class="bg-green-400 border-green-600 p-1.5 rounded border-solid font-bold text-white">Terverifikasi</span>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
