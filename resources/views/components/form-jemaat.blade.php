@props(['jemaat', 'sektors'])

<label for="nama" class="block text-black mt-3 font-bold">Nama Lengkap</label>
<input type="text" name="nama" value="{{old('nama',$jemaat->nama)}}" placeholder="Arif Chandra Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('nama')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<div class="block text-black mt-3 font-bold">
    <input type="checkbox" name="is_naposo" @if (old('is_naposo', $jemaat->is_naposo) == 1) {{"checked"}}@endif value="{{old('is_naposo',$jemaat->is_naposo)}}" id="is_naposo" onclick="isNaposo()"/>
    <label for="is_naposo" >Naposo</label>
</div>

<div id="block-of-naposo" style="@if (old('is_naposo', $jemaat->is_naposo) == 1) {{"display:block"}}@else {{"display:none"}} @endif">
    <label for="sektor_id" class="block text-black mt-3 font-bold">Sektor</label>
    <select id="sektor_id" name="sektor_id" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Sektor">
        <option value="" disabled selected>Pilih Sektor</option>
        @foreach ($sektors as $sektor)
            <option @if (old('sektor_id') == $sektor->id) {{"selected"}}@endif value="{{$sektor->id}}" >{{$sektor->nama}}</option>
        @endforeach
    </select>
    @error('sektor_id')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="no_anggota" class="block text-black mt-3 font-bold">No. Anggota</label>
    <input type="text" name="no_anggota" value="{{old('no_anggota',$jemaat->no_anggota)}}"
        placeholder="mis : 81941008001001" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" />
    @error('no_anggota')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>

<label for="tempat_lahir" class="block text-black mt-3 font-bold">Tempat Lahir</label>
<input type="text" name="tempat_lahir" value="{{old('tempat_lahir',$jemaat->tempat_lahir)}}" placeholder="Bandung" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('tempat_lahir')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="tanggal_lahir" class="block text-black mt-3 font-bold">Tanggal Lahir</label>
<input type="text" id="tanggal-lahir" name="tanggal_lahir" value="{{old('tanggal_lahir', $jemaat->tanggal_lahir ? date("d-m-Y",strToTime($jemaat->tanggal_lahir)) : '')}}" placeholder="dd-mm-yyyy" class="bg-gray-100 rounded-md" autocomplete="off" />
@error('tanggal_lahir')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label class="block text-black mt-3 font-bold" for="jenis_kelamin">Jenis Kelamin</label>
<input type="radio" class="form-radio h-5 w-5 text-gray-600" name="jenis_kelamin" value="Laki-laki" @if (old('jenis_kelamin',$jemaat->jenis_kelamin) == "Laki-laki") {{"checked"}}@endif />
<span class="ml-2 text-gray-700">Laki-laki</span>
<input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="jenis_kelamin" value="Perempuan"@if ( old('jenis_kelamin',$jemaat->jenis_kelamin) == "Perempuan") {{"checked"}}@endif />
<span class="ml-2 text-gray-700">Perempuan</span>
@error('jenis_kelamin')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label class="block text-black mt-3 font-bold" for="golongan_darah">Golongan Darah</label>
<select name="golongan_darah" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
    <option>-</option>
    <option @if (old('golongan_darah', $jemaat->golongan_darah) == "A") {{"selected"}}@endif>A</option>
    <option @if (old('golongan_darah', $jemaat->golongan_darah) == "B") {{"selected"}}@endif>B</option>
    <option @if (old('golongan_darah', $jemaat->golongan_darah) == "AB") {{"selected"}}@endif>AB</option>
    <option @if (old('golongan_darah', $jemaat->golongan_darah) == "O") {{"selected"}}@endif>O</option>
</select>
@error('golongan_darah')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="nomor_telepon" class="block text-black mt-3 font-bold">No. Telepon</label>
<input type="text" name="nomor_telepon" value="{{old('no_telepon',$jemaat->nomor_telepon)}}" placeholder="0859xxxxxxxxx" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('nomor_telepon')
    <div class="text-red-500">{{ $message }}</div>
@enderror


<label for="pendidikan" class="block text-black mt-3 font-bold">Pendidikan</label>
<select name="pendidikan" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Pendidikan Jemaat">
    <option>-</option>
    <option @if (old('pendidikan', $jemaat->pendidikan) == "SD") {{"selected"}}@endif value="SD">SD</option>
    <option @if (old('pendidikan', $jemaat->pendidikan) == "SMP") {{"selected"}}@endif value="SMP">SMP</option>
    <option @if (old('pendidikan', $jemaat->pendidikan) == "SMA/SMK") {{"selected"}}@endif value="SMA/SMK">SMA/SMK</option>
    <option @if (old('pendidikan', $jemaat->pendidikan) == "DIPLOMA (D1, D2, D3)") {{"selected"}}@endif value="DIPLOMA (D1, D2, D3)">DIPLOMA (D1, D2, D3)</option>
    <option @if (old('pendidikan', $jemaat->pendidikan) == "SARJANA (D4, S1)") {{"selected"}}@endif value="SARJANA (D4, S1)">SARJANA (D4, S1)</option>
    <option @if (old('pendidikan', $jemaat->pendidikan) == "MAGISTER (S2)") {{"selected"}}@endif value="MAGISTER (S2)">MAGISTER (S2)</option>
    <option @if (old('pendidikan', $jemaat->pendidikan) == "DOKTORAL (S3)") {{"selected"}}@endif value="DOKTORAL (S3)">DOKTORAL (S3)</option>
</select>
@error('pendidikan')
    <div class="text-red-500">{{ $message }}</div>
@enderror
{{-- ======================================= --}}

<div class="container">
    <label for="pekerjaan" class="block text-black mt-3 font-bold">Pekerjaan</label>
    <input id="pekerjaan" type="text" name="pekerjaan" value="{{old('pekerjaan',$jemaat->pekerjaan)}}" placeholder="Pekerjaan (auto suggestion)" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
    <div class="row z-10" id="match-list"></div>
    @error('pekerjaan')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
    @error('pekerjaan_api')
        <div class="text-red-500">data pekerjaan tidak diambil dari auto suggest</div>
    @enderror
</div>
@php
    $pekerjaanApi = false;
    if($jemaat->pekerjaan)
    {
        $pekerjaanApi = true;
    }
@endphp
<input name="pekerjaan_api" id="pekerjaan_api" type="hidden" value="{{$pekerjaanApi}}">

{{-- <label for="pekerjaan" class="block text-black mt-3 font-bold">Pekerjaan</label>
<input type="text" id="pekerjaan" name="pekerjaan" value="{{old('pekerjaan', $jemaat->pekerjaan)}}" placeholder="Pekerjaan" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('pekerjaan')
    <div class="text-red-500">{{ $message }}</div>
@enderror --}}

{{-- ======================================= --}}

<label for="tanggal_anggota" class="block text-black mt-3 font-bold">Tanggal Menjadi Anggota</label>
<input type="text" name="tanggal_anggota" id="tanggal-anggota" value="{{old('tanggal_anggota', $jemaat->tanggal_anggota ? date("d-m-Y",strToTime($jemaat->tanggal_anggota)) : '')}}" class="bg-gray-100 rounded-md" autocomplete="off" placeholder="dd-mm-yyyy"/>
@error('tanggal_anggota')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="hidup" class="block text-black mt-3 font-bold">Status Jemaat</label>
<input type="radio" class="form-radio h-5 w-5 text-gray-600" name="hidup" value="1" @if (old('hidup', $jemaat->hidup) == true) {{"checked"}}@endif />
<span class="ml-2 text-gray-700">Masih Hidup</span>
<input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="hidup" value="0" @if (old('hidup',$jemaat->hidup) == false) {{"checked"}}@endif />
<span class="ml-2 text-gray-700">Sudah Meninggal</span>
@error('hidup')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<script>
    const picker = new Pikaday({
        field: document.getElementById('tanggal-lahir'),
        yearRange: [1900, 2100],
        format: 'DD-MM-YYYY',
    })
    picker.getMoment()
    const picker2 = new Pikaday({
        field: document.getElementById('tanggal-anggota'),
        yearRange: [1900, 2100],
        format: 'DD-MM-YYYY',
    })
    picker2.getMoment()

    const matchList = document.getElementById("match-list");
    const searchInput = document.getElementById("pekerjaan");
    const pekerjaanApi = document.getElementById("pekerjaan_api");

    const url = window.location.origin + '/api/pekerjaan/'
    searchInput.oninput = async ()=> {
        getPekerjaan();
        pekerjaanApi.value = '';
    }

    const setSearchValue = (jemaatNama) => {
        searchInput.value = jemaatNama;
        pekerjaanApi.value = true;
        matchList.innerHTML = '';
    }

    //============================================================
    const outputHtml = matches => {
        if (matches.length>0){
            const htmlFetched = matches.map(match => `
                <div onclick="setSearchValue('${match}')" class="cursor-pointer p-2 bg-gray-200 hover:bg-gray-300 border border-gray-400">
                    <p><strong>${match}</strong></p>
                </div>
            `).join('');
            matchList.innerHTML = htmlFetched;
        } else matchList.innerHTML = '';
    }

    async function getPekerjaan(){
        var x = document.getElementById("pekerjaan");
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

    const isNaposo = () => {
        var checkBox = document.getElementById("is_naposo")
        var blockNaposo = document.getElementById("block-of-naposo")
        if (checkBox.checked) {
            blockNaposo.style.display = "block"
        } else {
            blockNaposo.style.display = "none"
        }
        checkBox.value = checkBox.checked;
    }

</script>
