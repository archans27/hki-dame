<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Data Katekisasi') }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{route('katekisasi.store')}}" method="post">
                    @method('POST')
                    @csrf

                    <fieldset class="border-solid border-blue-500 border-2 px-4 pb-4">
                        <legend class="px-2 text-lg">Data Jemaat:</legend>
                        <label for="nama" class="block text-black mt-3 font-bold">Nama Jemaat</label>
                        <input id="jemaat_sugestion" type="text" name="nama" value="{{old('nama')}}" placeholder="Arif Chandra Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        <div class="row z-10" id="match-list"></div>
                        @error('nama')
                            <div class="text-red-500">{{ 'Isian tidak diisi / tidak menggunakan auto sugestion.' }}</div>
                        @enderror

                        <input name="jemaat_id" id="jemaat_id" type="hidden" value="dummy">
                        @error('jemaat_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="nomor_telepon" class="block text-black mt-3 font-bold">No. Telepon</label>
                        <input id="nomor_telepon" type="text" name="nomor_telepon" value="{{old('nomor_telepon')}}" placeholder="Autofill" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" readonly="readonly"/>
                    </fieldset>

                    <fieldset class="border-solid border-blue-500 border-2 px-4 pb-4 mt-5">
                        <legend class="px-2 text-lg">Data Katekisasi:</legend>

                        <label for="tanggal" class="block text-black mt-3 font-bold">Tanggal:</label>
                        <input id="tanggal" type="text" name="tanggal" value="{{old('tanggal')}}" placeholder="dd-mm-yyyy" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        @error('tanggal')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="status" class="block text-black mt-3 font-bold">Status:</label>
                        <select name="status" class="w-1020 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="L" @if (old('status') == 'L') {{"selected"}}@endif>Lajang</option>
                            <option value="M" @if (old('status') == 'M') {{"selected"}}@endif>Mau Menikah</option>
                        </select>
                        @error('status')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="hobi" class="block text-black mt-3 font-bold">Hobi:</label>
                        <input type="text" name="hobi" value="{{old('hobi')}}" placeholder="Sepak Bola, Bermusik ..." class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                        @error('hobi')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="cita" class="block text-black mt-3 font-bold">Cita-cita:</label>
                        <input type="text" name="cita" value="{{old('cita')}}" placeholder="Dokter, Polisi ..." class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                        @error('cita')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                    </fieldset>

                    @if (Auth::user()->role == 'super')
                        <label for="temporary" class="block text-black mt-3 font-bold">Verifikasi</label>
                        <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="temporary" value="1" @if (old('temporary', $katekisasi->temporary) == true) {{"checked"}}@endif />
                        <span class="ml-2 text-gray-700">Belum terverifikasi</span>
                        <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="temporary" value="0" @if (old('temporary', $katekisasi->temporary) == false) {{"checked"}}@endif />
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
                
                    <x-back-button :link="url('/katekisasi')" />
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
    const nomorTelepon = document.getElementById("nomor_telepon");

    const url = window.location.origin + '/api/jemaatKatekisasi/'
    let res = [];
    
    searchInput.oninput = async ()=> {
        getJemaat();
        jemaatId.value = '';
        nomorTelepon.value = '';
    }

    const setSearchValue = (index) => {
        searchInput.value = res[index].nama;
        jemaatId.value = res[index].id;
        nomorTelepon.value = res[index].nomor_telepon;
        matchList.innerHTML = '';
    }

    
    //============================================================
    const outputHtml = matches => {
        if (matches.length>0){
            res = matches;
            i = 0;
            const htmlFetched = matches.map(match => `
                <div onclick="setSearchValue('${i++}')" class="cursor-pointer p-2 bg-gray-200 hover:bg-gray-300 border border-gray-400">
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