@props(['jemaat', 'formAction', 'method'])

<form action="{{$formAction}}" method="post">
    @method($method)
    @csrf

    <label for="keluarga" class="block text-black mt-3 font-bold">Keluarga</label>
    <input id="keluarga" type="text" name="keluarga_id" value="{{old('keluarga',$jemaat->keluarga_id)}}" placeholder="Nama kepala keluarga" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('keluarga')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="nama" class="block text-black mt-3 font-bold">Nama lengkap</label>
    <input type="text" name="nama" value="{{old('nama',$jemaat->nama)}}" placeholder="Nama lengkap jemaat" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('nama')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="no_anggota" class="block text-black mt-3 font-bold">No anggota</label>
    <input type="text" name="no_anggota" value="{{old('no_anggota',$jemaat->no_anggota)}}" placeholder="No anggota jemaat" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('no_anggota')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tempat_lahir" class="block text-black mt-3 font-bold">Tempat lahir</label>
    <input type="text" name="tempat_lahir" value="{{old('tempat_lahir',$jemaat->tempat_lahir)}}" placeholder="Tempat lahir jemaat" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tempat_lahir')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tanggal_lahir" class="block text-black mt-3 font-bold">Tanggal lahir</label>
    <input type="text" id="tanggal-lahir" name="tanggal_lahir" value="{{old('jemaat',$jemaat->tanggal_lahir)}}" class="bg-gray-100 rounded-md"/>
    @error('tanggal_lahir')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label class="block text-black mt-3 font-bold" for="jenis_kelamin">Jenis kelamin</label>
    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="jenis_kelamin" value="Laki-laki" @if (old('jenis_kelamin',$jemaat->jenis_kelamin) == "Laki-laki") {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Laki-laki</span>
    <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="jenis_kelamin" value="Perempuan"@if ( old('jenis_kelamin',$jemaat->jenis_kelamin) == "Perempuan") {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Perempuan</span>
    @error('jenis_kelamin')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label class="block text-black mt-3 font-bold" for="golongan_darah">Golongan darah</label>
    <select name="golongan_darah" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Regular input">
        <option>-</option>
        <option @if (old('golongan_darah', $jemaat->golongan_darah) == "A") {{"selected"}}@endif>A</option>
        <option @if (old('golongan_darah', $jemaat->golongan_darah) == "B") {{"selected"}}@endif>B</option>
        <option @if (old('golongan_darah', $jemaat->golongan_darah) == "AB") {{"selected"}}@endif>AB</option>
        <option @if (old('golongan_darah', $jemaat->golongan_darah) == "O") {{"selected"}}@endif>O</option>
    </select>
    @error('golongan_darah')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat rumah</label>
    <input type="text" name="alamat_rumah" value="{{old('alamat_rumah', $jemaat->alamat_rumah)}}" placeholder="Tempat lahir jemaat" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('alamat_rumah')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="status_rumah" class="block text-black mt-3 font-bold">Status tempat tinggal</label>
    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="status_rumah" value="Tetap" @if (old('status_rumah',$jemaat->status_rumah) == "Tetap") {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Tetap</span>
    <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="status_rumah" value="Sementara" @if (old('status_rumah',$jemaat->status_rumah) == "Sementara") {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Sementara</span>
    @error('status_rumah')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="nomor_telepon" class="block text-black mt-3 font-bold">Nomor telepon</label>
    <input type="text" name="nomor_telepon" value="{{old('no_telepon',$jemaat->nomor_telepon)}}" placeholder="Nomor telepon" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('nomor_telepon')
        <div class="text-red-500">{{ $message }}</div>
    @enderror


    <label for="pendidikan" class="block text-black mt-3 font-bold">Pendidikan</label>
    <select name="pendidikan" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Regular input">
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

    <label for="pekerjaan" class="block text-black mt-3 font-bold">Pekerjaan</label>
    <input type="text" name="pekerjaan" value="{{old('pekerjaan', $jemaat->pekerjaan)}}" placeholder="Pekerjaan" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('pekerjaan')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    {{-- //todo ubah jadi dinamis tergantung sektornya --}}
    <label for="sektor_id" class="block text-black mt-3 font-bold">Sektor</label>
    <select name="sektor_id" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Regular input">
        <option>-</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "1") {{"selected"}}@endif value='1' >Sektor 1</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "2") {{"selected"}}@endif value='2'>Sektor 2</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "3") {{"selected"}}@endif value='3'>Sektor 3</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "4") {{"selected"}}@endif value='4'>Sektor 4</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "5") {{"selected"}}@endif value='5'>Sektor 5</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "6") {{"selected"}}@endif value='6'>Sektor 6</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "7") {{"selected"}}@endif value='7'>Sektor 7</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "8") {{"selected"}}@endif value='8'>Sektor 8</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "9") {{"selected"}}@endif value='9'>Sektor 9</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "10") {{"selected"}}@endif value='10'>Sektor 10</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "11") {{"selected"}}@endif value='11'>Sektor 11</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "12") {{"selected"}}@endif value='12'>Sektor 12</option>
        <option @if (old('sektor_id', $jemaat->sektor_id) == "13") {{"selected"}}@endif value='13'>Sektor 13</option>
    </select>
    @error('sektor_id')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tanggal_anggota" class="block text-black mt-3 font-bold">Tanggal menjadi anggota</label>
    <input type="text" name="tanggal_anggota" id="tanggal-anggota" value="{{old('tanggal_anggota', $jemaat->tanggal_anggota)}}" class="bg-gray-100 rounded-md"/>
    @error('tanggal_anggota')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="hidup" class="block text-black mt-3 font-bold">Status jemaat</label>
    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="hidup" value="1" @if (old('hidup', $jemaat->hidup) == true) {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Masih hidup</span>
    <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="hidup" value="0" @if (old('hidup',$jemaat->hidup) == false) {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Sudah menginggal</span>
    @error('hidup')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <div class="clear-both py-5"></div>
    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
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

<script>
    const picker = new Pikaday({
        field: document.getElementById('tanggal-lahir'),
        format: 'YYYY-MM-DD',
    })
    picker.getMoment()
    const picker2 = new Pikaday({
        field: document.getElementById('tanggal-anggota'),
        format: 'YYYY-MM-DD',
    })
</script>