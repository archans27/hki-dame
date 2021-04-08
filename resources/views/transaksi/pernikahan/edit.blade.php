<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data '.$jenis['data']) }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 pb-5">

                <form action="{{route(''.$jenis['uri'].'.update',$pernikahan->id)}}" method="post">
                    @method('PUT')
                    @csrf

                    <fieldset class="border-solid border-blue-500 border-2 p-4 my-8">
                        <legend class="px-2 text-lg">Data Keluarga:</legend>
                        <label class="block text-black mt-3 font-bold">Nama Kepala Keluarga</label>
                        <input type="text" value="{{$keluarga->kepala_keluarga}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>
                        <input name="keluarga_id" id="keluarga_id" type="hidden" value="{{old('keluarga_id',$pernikahan->keluarga_id ?? '')}}" />
                        <input name="kepala_keluarga" id="kepala_keluarga" type="hidden" value="{{old(' ',$pernikahan->kepala_keluarga ?? '')}}" />

                        <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat Rumah</label>
                        <input type="text" value="{{$keluarga->alamat_rumah}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>
                    </fieldset>

                    <fieldset class="border-solid border-blue-500 border-2 p-4 my-8">
                        <legend class="px-2 text-lg">Data Mempelai:</legend>

                        <label for="mempelai" class="block text-black font-bold  mr-2">Nama Mempelai</label>
                        <select name="mempelai" class="w-1020 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                          <option value="" disabled selected>Pilih nama mempelai</option>
                          @foreach ($detailKeluargas as $detailKeluarga)
                            @if ($detailKeluarga->hubungan == 'Anak')
                                <option @if (old('mempelai', $pernikahan->mempelai) == $detailKeluarga->jemaat_id) {{"selected"}}@endif value="{{$detailKeluarga->jemaat_id}}" >{{$detailKeluarga->nama}}</option>
                            @endif
                          @endforeach
                        </select>
                        @error('mempelai')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="pasangan_mempelai_sugestion" class="block text-black mt-3 font-bold">Nama Pasangan Mempelai</label>
                        <input type="text" name="pasangan_mempelai_sugestion" id="pasangan_mempelai_sugestion" value="{{old('pasangan_mempelai_sugestion',$pernikahan->nama_pasangan_mempelai  ?? '')}}" placeholder="Arif Chandra Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        <div class="row z-10" id="match-list"></div>
                        @error('pasangan_mempelai_sugestion')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <input name="pasangan_mempelai" id="pasangan_mempelai" type="hidden" value="{{$pernikahan->pasangan_mempelai ?? ''}}">
                        @error('pasangan_mempelai')
                            <div class="text-red-500">Data tidak diambil dari auto suggest </div>
                        @enderror

                        <label for="tanggal_pemberkatan" class="block text-black mt-3 font-bold">Tanggal {{ $jenis['data'] }}</label>
                        <input type="text" name="tanggal_pemberkatan" id="tanggal-pemberkatan" value="{{old('tanggal_pemberkatan', $pernikahan->tanggal_pemberkatan ? date("d-m-Y",strToTime($pernikahan->tanggal_pemberkatan)) : '')}}" class="bg-gray-100 rounded-md" autocomplete="off" placeholder="dd-mm-yyyy"/>
                        @error('tanggal_pemberkatan')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                    </fieldset>

                    <div class="grid grid-cols-2 gap-4 my-8">
                        <fieldset class="border-solid border-blue-500 border-2 p-4 rounded-md">
                            <legend class="px-2 text-lg">Ucapan Syukur dari Paranak:</legend>

                        @if($jenis['jenis'] == 'M')
                            <label for="tk_akte_nikah_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Akte Nikah:</label>
                            <input type="text" name="tk_akte_nikah_paranak" value="{{old('tk_akte_nikah_paranak',$ucapanSyukur['paranak']['akte_nikah'] ??  '' )}}" placeholder="Ucapan Syukur Untuk Akte Nikah (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_akte_nikah_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        @endif

                            <label for="tk_gereja_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Gereja:</label>
                            <input type="text" name="tk_gereja_paranak" value="{{old('tk_gereja_paranak',$ucapanSyukur['paranak']['gereja']  ?? '')}}" placeholder="Ucapan Syukur Untuk Gereja (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_gereja_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_majelis_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Majelis:</label>
                            <input type="text" name="tk_majelis_paranak" value="{{old('tk_majelis_paranak',$ucapanSyukur['paranak']['majelis']  ?? '')}}" placeholder="Ucapan Syukur Untuk Majelis (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_majelis_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_pendeta_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Pendeta:</label>
                            <input type="text" name="tk_pendeta_paranak" value="{{old('tk_pendeta_paranak',$ucapanSyukur['paranak']['pendeta']  ?? '')}}" placeholder="Ucapan Syukur Untuk Pendeta (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_pendeta_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_guru_huria_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Guru Huria:</label>
                            <input type="text" name="tk_guru_huria_paranak" value="{{old('tk_guru_huria_paranak',$ucapanSyukur['paranak']['guru_huria']  ?? '')}}" placeholder="Ucapan Syukur Untuk Guru Huria (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_guru_huria_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_sintua_sektor_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Sintua Sektor:</label>
                            <input type="text" name="tk_sintua_sektor_paranak" value="{{old('tk_sintua_sektor_paranak',$ucapanSyukur['paranak']['sintua_sektor']  ?? '')}}" placeholder="Ucapan Syukur Untuk Sintua Sektor (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_sintua_sektor_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_lain_lain_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Lainya:</label>
                            <input type="text" name="tk_lain_lain_paranak" value="{{old('tk_lain_lain_paranak',$ucapanSyukur['paranak']['lain_lain']  ?? '')}}" placeholder="Ucapan Syukur Untuk Lainnya (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_lain_lain_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                        </fieldset>
                        <fieldset class="border-solid border-blue-500 border-2 p-4 rounded-md">
                            <legend class="px-2 text-lg">Ucapan Syukur dari parboru:</legend>
                        @if($jenis['jenis'] == 'M')
                            <label for="tk_akte_nikah_parboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Akte Nikah:</label>
                            <input type="text" name="tk_akte_nikah_parboru" value="{{old('tk_akte_nikah_parboru',$ucapanSyukur['parboru']['akte_nikah']  ?? '')}}" placeholder="Ucapan Syukur Untuk Akte Nikah (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_akte_nikah_parboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        @endif

                            <label for="tk_gereja_parboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Gereja:</label>
                            <input type="text" name="tk_gereja_parboru" value="{{old('tk_gereja_parboru',$ucapanSyukur['parboru']['gereja']  ?? '')}}" placeholder="Ucapan Syukur Untuk Gereja (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_gereja_parboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_majelis_parboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Majelis:</label>
                            <input type="text" name="tk_majelis_parboru" value="{{old('tk_majelis_parboru',$ucapanSyukur['parboru']['majelis']  ?? '')}}" placeholder="Ucapan Syukur Untuk Majelis (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_majelis_parboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_pendeta_parboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Pendeta:</label>
                            <input type="text" name="tk_pendeta_parboru" value="{{old('tk_pendeta_parboru',$ucapanSyukur['parboru']['pendeta']  ?? '')}}" placeholder="Ucapan Syukur Untuk Pendeta (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_pendeta_parboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_guru_huria_parboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Guru Huria:</label>
                            <input type="text" name="tk_guru_huria_parboru" value="{{old('tk_guru_huria_parboru',$ucapanSyukur['parboru']['guru_huria']  ?? '')}}" placeholder="Ucapan Syukur Untuk Guru Huria (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_guru_huria_parboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_sintua_sektor_parboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Sintua Sektor:</label>
                            <input type="text" name="tk_sintua_sektor_parboru" value="{{old('tk_sintua_sektor_parboru',$ucapanSyukur['parboru']['sintua_sektor']  ?? '')}}" placeholder="Ucapan Syukur Untuk Sintua Sektor (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_sintua_sektor_parboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_lain_lain_parboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Lainya:</label>
                            <input type="text" name="tk_lain_lain_parboru" value="{{old('tk_lain_lain_parboru',$ucapanSyukur['parboru']['lain_lain']  ?? '')}}" placeholder="Ucapan Syukur Untuk Lainnya (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_lain_lain_parboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>
                    

                    <div class="clear-both px-5 pb-5"></div>
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>
                
                    <x-back-button :link="url('/'.$jenis['uri'].'')" />
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const picker = new Pikaday({
        field: document.getElementById('tanggal-pemberkatan'),
        yearRange: [1900, 2100],
        format: 'DD-MM-YYYY',
    })

    const matchList = document.getElementById("match-list");
    const searchInput = document.getElementById("pasangan_mempelai_sugestion");
    const pasanganMempelaiId = document.getElementById("pasangan_mempelai");

    const url = window.location.origin + '/api/jemaat/'
    searchInput.oninput = async ()=> getJemaat(searchInput);

    const setSearchValue = (jemaatNama, jemaatId) => {
        searchInput.value = jemaatNama;
        pasanganMempelaiId.value = jemaatId;
        matchList.innerHTML = '';
    }
    
    
    const outputHtml = matches => {
        if (matches.length>0){
            const htmlFetched = matches.map(match => `
                <div onclick="setSearchValue('${match.nama}', '${match.id}')" class="cursor-pointer p-2 bg-gray-200 hover:bg-gray-300 border border-gray-400">
                    <p><strong>${match.nama}</strong> - ${match.tanggal_lahir}</p>
                </div>
            `).join('');
            matchList.innerHTML = htmlFetched;
        } else matchList.innerHTML = '';
    }

    async function getJemaat(x){
        if(x.value.length > 1){
            x.value = x.value.toLowerCase();
            const response = await fetch(url+x.value);
            outputHtml(await response.json());
        }
        else matchList.innerHTML = '';
    }

    window.addEventListener('click', function(e){   
        if (!document.getElementById('body').contains(e.target)){
            matchList.innerHTML = '';
        }
    });
</script>

