<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Data Meninggal') }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{route('meninggal.store')}}" method="post">
                    @method('POST')
                    @csrf

                    <fieldset class="border-solid border-blue-500 border-2 px-4 pb-4">
                        <legend class="px-2 text-lg">Data Jemaat:</legend>
                        <label for="nama" class="block text-black mt-3 font-bold">Nama Jemaat</label>
                        <input id="jemaat_sugestion" type="text" name="nama" value="{{old('nama')}}" placeholder="Arif C. Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        <div class="row z-10" id="match-list"></div>
                        @error('nama')
                            <div class="text-red-500">{{ 'Isian tidak diisi / tidak menggunakan auto sugestion.' }}</div>
                        @enderror

                        <input name="jemaat_id" id="jemaat_id" type="hidden" value="dummy">
                        @error('jemaat_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset class="border-solid border-blue-500 border-2 px-4 pb-4 mt-5">
                        <legend class="px-2 text-lg">Data Meninggal:</legend>

                        <label for="tanggal" class="block text-black mt-3 font-bold">Tanggal:</label>
                        <input id="tanggal" type="text" name="tanggal" value="{{old('tanggal')}}" placeholder="dd-mm-yyyy" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        @error('tanggal')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="keterangan" class="block text-black mt-3 font-bold">Keterangan:</label>
                        <input type="text" name="keterangan" value="{{old('keterangan')}}" placeholder="Meninggal akibat ..." class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                        @error('keterangan')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                    </fieldset>

                    @if (Auth::user()->role == 'super')
                        <label for="temporary" class="block text-black mt-3 font-bold">Verifikasi</label>
                        <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="temporary" value="1" @if (old('temporary', $meninggal->temporary) == true) {{"checked"}}@endif />
                        <span class="ml-2 text-gray-700">Belum terverifikasi</span>
                        <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="temporary" value="0" @if (old('temporary', $meninggal->temporary) == false) {{"checked"}}@endif />
                        <span class="ml-2 text-gray-700">Terverifikasi</span>
                        @error('hidup')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    @endif

                    <div class="clear-both px-5 pb-5"></div>
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>
                
                    <x-back-button :link="url('/meninggal')" />
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const picker = new Pikaday({
        field: document.getElementById('tanggal'),
        yearRange: [1900, 2100],
        format: 'DD-MM-YYYY',
    })
    picker.getMoment();

    const matchList = document.getElementById("match-list");
    const searchInput = document.getElementById("jemaat_sugestion");
    const jemaatId = document.getElementById("jemaat_id");

    const url = window.location.origin + '/api/jemaat/'
    searchInput.oninput = async ()=> getJemaat();

    const setSearchValue = (jemaatNama, jemaatIdRes) => {
        searchInput.value = jemaatNama;
        jemaatId.value = jemaatIdRes;
        matchList.innerHTML = '';
    }

    
    //============================================================
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

    async function getJemaat(){
        var x = document.getElementById("jemaat_sugestion");
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