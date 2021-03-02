<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Sintua') }}
        </h2>
    </x-slot>

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{url('/sintua/'.$sintua->id)}}" method="post">
                    @method('PUT')
                    @csrf

                    <label for="nama" class="block text-black mt-3 font-bold">Nama Sintua</label>
                    <input id="jemaat_sugestion" type="text" name="nama" value="{{old('nama',$sintua->nama)}}" placeholder="Nama Sintua" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                    <div class="row z-10" id="match-list"></div>
                    @error('nama')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror


                    <input name="jemaat_id" id="jemaat_id" type="hidden" value="">
                    @error('jemaat_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="wilayah" class="block text-black mt-3 font-bold">Nama Sektor</label>
                    <input type="text" name="wilayah" value="{{old('wilayah',$sintua->nama_sektor)}}" placeholder="Nama Sektor" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                    @error('wilayah')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div class="clear-both py-5"></div>

                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>

                    <x-back-button :link="url('/sektor')" />

                </form>

            </div>
        </div>
    </div>
    <script>
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
</x-app-layout>
