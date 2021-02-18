<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Jemaat') }}
        </h2>
    </x-slot>

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <form action="{{url('keluarga')}}" method="post">
                    @method('POST')
                    @csrf
                    <div class="container">
                        <label for="kepala_keluarga" class="block text-black mt-3 font-bold">Nama Kepala Keluarga</label>
                        <input type="text" name="kepala_keluarga" value="{{$keluargas[0]->kepala_keluarga}}" placeholder="Nama kepala keluarga" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full" autocomplete="off" disabled/>
                        @error('kepala_keluarga')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <input name="kepala_keluarga_id" id="kepala_keluarga_id" type="hidden" value="{{$keluargas[0]->kepala_keluarga_id}}">
                    @error('kepala_keluarga_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="no_keluarga" class="block text-black mt-3 font-bold">No Keluarga</label>
                    <input id="no_keluarga" type="text" name="no_keluarga" value="{{$keluargas[0]->no_keluarga}}" placeholder="Nomor Keluarga" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                    @error('no_keluarga')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="sektor_id" class="block text-black mt-3 font-bold">Sektor</label>
                    <select name="sektor_id" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Regular input">
                        <option>-</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "1") {{"selected"}}@endif value='1' >Sektor 1</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "2") {{"selected"}}@endif value='2'>Sektor 2</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "3") {{"selected"}}@endif value='3'>Sektor 3</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "4") {{"selected"}}@endif value='4'>Sektor 4</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "5") {{"selected"}}@endif value='5'>Sektor 5</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "6") {{"selected"}}@endif value='6'>Sektor 6</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "7") {{"selected"}}@endif value='7'>Sektor 7</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "8") {{"selected"}}@endif value='8'>Sektor 8</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "9") {{"selected"}}@endif value='9'>Sektor 9</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "10") {{"selected"}}@endif value='10'>Sektor 10</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "11") {{"selected"}}@endif value='11'>Sektor 11</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "12") {{"selected"}}@endif value='12'>Sektor 12</option>
                        <option @if (old('sektor_id', $keluargas[0]->sektor_id) == "13") {{"selected"}}@endif value='13'>Sektor 13</option>
                    </select>
                    @error('sektor_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat rumah</label>
                    <input type="text" name="alamat_rumah" value="{{old('alamat_rumah', $keluargas[0]->alamat_rumah)}}" placeholder="Alamt rumah" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                    @error('alamat_rumah')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div class="clear-both my-5"></div>

                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>

                    <a href="{{route('jemaat.index')}}">
                        <button type="button" class='relative text-blue-500 border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                            <span class="material-icons">
                                backspace
                            </span>
                            Kembali
                        </button>
                    </a>

                </form>
                <hr class="clear-both my-5 border-2"/>

                <form action="{{url('detailkeluarga')}}" method="post">
                    @method('POST')
                    @csrf
                    <div class="container">
                        <label for="kepala_keluarga" class="block text-black mt-3 font-bold">Nama anggota keluarga</label>
                        <input id="jemaat_sugestion" type="text" name="kepala_keluarga" value="{{old('nama')}}" placeholder="Nama anggota keluarga" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        <div class="row z-10" id="match-list">
                        @error('kepala_keluarga')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <input name="keluarga_id" type="hidden" value="{{$keluargas[0]->keluarga_id}}">
                    <input name="jemaat_id" id="jemaat_id" type="hidden" value="">
                    @error('id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="hubungan" class="block text-black mt-3 font-bold">Hubungan dalam keluarga</label>
                    <select name="hubungan" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Regular input">
                        <option @if (old('hubungan') == "Suami") {{"selected"}}@endif value='Suami' >Suami</option>
                        <option @if (old('hubungan') == "Istri") {{"selected"}}@endif value='Istri'>Istri</option>
                        <option @if (old('hubungan') == "Anak") {{"selected"}}@endif value='Anak'>Anak</option>
                        <option @if (old('hubungan') == "Menantu") {{"selected"}}@endif value='Menantu'>Menantu</option>
                        <option @if (old('hubungan') == "Cucu") {{"selected"}}@endif value='Cucu'>Cucu</option>
                        <option @if (old('hubungan') == "Orang Tua") {{"selected"}}@endif value='Orang Tua'>Orang Tua</option>
                        <option @if (old('hubungan') == "Mertua") {{"selected"}}@endif value='Mertua'>Mertua</option>
                        <option @if (old('hubungan') == "Famili Lain") {{"selected"}}@endif value='Famili Lain'>Famili Lain</option>
                    </select>
                    @error('hubungan')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div class="clear-both my-5"></div>

                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 rounded overflow-hidden'>
                        <span class="material-icons">
                            add
                        </span>
                        Tambah anggota KK
                    </button>

                </form>

                <div class="bg-white overflow-x-auto mt-6">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                          <tr class="bg-gray-800 text-white">
                            <th class="px-5 py-2 text-left">Nama Anggota Keluarga</th>
                            <th class="px-5 py-2">Hubungan dalam Keluarga</th>
                            <th class="px-5 py-2">Jenis kelamin</th>
                            <th class="px-5 py-2 text-left">Action</th>
                          </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($keluargas as $keluarga)
                              <tr class="bg-white  border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                                <td class="px-5 py-2 text-left"> {{$keluarga->nama}}</td>
                                <td class="px-5 py-2 text-center">{{$keluarga->hubungan}}</td>
                                <td class="px-5 py-2 text-center">{{$keluarga->jenis_kelamin}}</td>
                                <td class="px-5 py-2 text-center">

                                    <form method="post" action="" class="float-left">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                          onclick="event.preventDefault();
                                            toggleModal('modal-delete');
                                            deleteJemaat('{{url('/detailkeluarga/'.$keluarga->jemaat_id)}}')"
                                        >
                                          <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                            delete
                                            </span>
                                        </button>
                                      </form>


                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>

            </div>
        </div>
    </div>

    <x-popup-confirm
    :modalId="'modal-delete'"
    :formId="'form-modal-delete'"
    :title="'Delete Data'"
    :message="'Apakah anda yakin akan menghapus data ini?'"
    :action="'Hapus data'"
    :actionUrl="url('/')"
    :actionMethod="'DELETE'"
  />

    <script>
    const matchList = document.getElementById("match-list");
    const searchInput = document.getElementById("jemaat_sugestion");
    const jemaat_id = document.getElementById("jemaat_id");

    const url = window.location.origin + '/api/jemaat/'
    searchInput.oninput = async ()=> getJemaat();

    const setSearchValue = (jemaatNama, jemaatId) => {
        searchInput.value = jemaatNama;
        jemaat_id.value = jemaatId;
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

    function deleteJemaat(url){
        document.getElementById('form-modal-delete').setAttribute('action', url);
    }

    </script>
</x-app-layout>
