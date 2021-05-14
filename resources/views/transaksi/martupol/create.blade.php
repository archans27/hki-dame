<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Data Martupol ') }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{route('martupol.store')}}" method="post">
                    @method('POST')
                    @csrf

                    <fieldset class="border-solid border-blue-500 border-2 px-4 pb-4">
                        <legend class="px-2 text-lg">Data Keluarga:</legend>
                        <label for="kepala_keluarga" class="block text-black mt-3 font-bold">Nama Kepala Keluarga</label>
                        <input id="kepala_keluarga" type="text" name="kepala_keluarga" value="{{old('kepala_keluarga')}}" placeholder="Arif Chandra Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        <div class="row z-10" id="match-list"></div>
                        @error('kepala_keluarga')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        @error('keluarga_id')
                            <div class="text-red-500">Data tidak diambil dari auto suggest</div>
                        @enderror
                        <input name="keluarga_id" id="keluarga_id" type="hidden" value="{{old('keluarga_id',$jemaat->keluarga_id ?? '')}}" />

                        <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat Rumah</label>
                        <input id="alamat_rumah" type="text" name="alamat_rumah" value="{{old('alamat_rumah')}}" placeholder="Autofill" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" readonly="readonly"/>
                    </fieldset>

                    

                    <div class="clear-both px-5 pb-5"></div>
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>
                
                    <x-back-button :link="url('/martupol')" />
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const matchList = document.getElementById("match-list");
    const searchInput = document.getElementById("kepala_keluarga");
    const keluargaId = document.getElementById("keluarga_id");
    const alamatRumah = document.getElementById("alamat_rumah");
    

    const url = window.location.origin + '/api/keluarga/'
    let res = [];

    searchInput.oninput = async ()=> {
        getKeluarga();
        keluargaId.value = '';
        alamatRumah.value = '';
    }

    const setSearchValue = (index) => {
        searchInput.value = res[index].kepala_keluarga;
        alamatRumah.value = res[index].alamat_rumah;
        keluargaId.value = res[index].id;
        matchList.innerHTML = '';
    }

    
    //============================================================
    const outputHtml = matches => {
        if (matches.length>0){
            res = matches;
            i = 0;
            const htmlFetched = matches.map(match => `
                <div onclick="setSearchValue('${i++}')" class="cursor-pointer p-2 bg-gray-200 hover:bg-gray-300 border border-gray-400">
                    <p><strong>${match.kepala_keluarga}</strong></p>
                </div>
            `).join('');
            matchList.innerHTML = htmlFetched;
        } else matchList.innerHTML = '';
    }

    async function getKeluarga(){
        var x = document.getElementById("kepala_keluarga");
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