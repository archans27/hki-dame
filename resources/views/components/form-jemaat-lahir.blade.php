@props(['jemaat','ucapanSyukur'])
<fieldset class="border-solid border-blue-500 border-2 px-4 pb-4 mt-5">
    <legend class="px-2 text-lg">Data anak:</legend>

    <label for="nama" class="block text-black mt-3 font-bold">Nama Lengkap:</label>
    <input type="text" name="nama" value="{{old('nama',$jemaat->nama  ?? '')}}" placeholder="Arif Chandra Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('nama')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tanggal_lahir" class="block text-black mt-3 font-bold">Tanggal Lahir:</label>
    <input id="tanggal_lahir" type="text" name="tanggal_lahir" value="{{old('tanggal_lahir',$jemaat->tanggal_lahir ? date("d-m-Y",strToTime($jemaat->tanggal_lahir)) : '')}}" placeholder="dd-mm-yyyy" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
    @error('tanggal_lahir')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="jam_lahir" class="block text-black mt-3 font-bold">Lahir pada pukul:</label>
    <input type="time" id="jam_lahir" name="jam_lahir" value="{{old('jam_lahir',$jemaat->jam_lahir ?? '')}}" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/6 sm:w-full" required>

    <label for="tempat_lahir" class="block text-black mt-3 font-bold">Tempat Lahir:</label>
    <input type="text" name="tempat_lahir" value="{{old('tempat_lahir',$jemaat->tempat_lahir  ?? '')}}" placeholder="Bandung" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tempat_lahir')
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

    <label class="block text-black mt-3 font-bold" for="status_anak">Status Anak</label>
    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="status_anak" value="Kandung" @if (old('status_anak',$jemaat->status_anak) == "Kandung") {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Kandung</span>
    <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="status_anak" value="Angkat"@if ( old('status_anak',$jemaat->status_anak) == "Angkat") {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Angkat</span>
    @error('status_anak')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

</fieldset>

<fieldset class="border-solid border-blue-500 border-2 px-4 pb-4 mt-5">
    <legend class="px-2 text-lg">Data ucapan syukur jemaat baru:</legend>

    <label for="tk_gereja" class="block text-black mt-3 font-bold">Ucapan Syukur Kepada Gereja:</label>
    <input type="text" name="tk_gereja" value="{{old('tk_gereja',$ucapanSyukur['gereja']  ?? '')}}" placeholder="(numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_gereja')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_majelis" class="block text-black mt-3 font-bold">Ucapan Syukur Kepada Majelis Jemaat:</label>
    <input type="text" name="tk_majelis" value="{{old('tk_majelis',$ucapanSyukur['majelis']  ?? '')}}" placeholder="(numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_majelis')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_pendeta" class="block text-black mt-3 font-bold">Ucapan Syukur Kepada Pendeta:</label>
    <input type="text" name="tk_pendeta" value="{{old('tk_pendeta',$ucapanSyukur['pendeta']  ?? '')}}" placeholder="(numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_pendeta')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_pendeta_diperbantukan" class="block text-black mt-3 font-bold">Ucapan Syukur Kepada Pendeta Diperbantukan:</label>
    <input type="text" name="tk_pendeta_diperbantukan" value="{{old('tk_pendeta_diperbantukan',$ucapanSyukur['pendeta_diperbantukan']  ?? '')}}" placeholder="(numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_pendeta_diperbantukan')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
    

    <label for="tk_guru_huria" class="block text-black mt-3 font-bold">Ucapan syukur untuk Guru Jemaat:</label>
    <input type="text" name="tk_guru_huria" value="{{old('tk_guru_huria',$ucapanSyukur['guru_huria']  ?? '')}}" placeholder="(numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_guru_huria')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_lain_lain" class="block text-black mt-3 font-bold">Ucapan Syukur Lain-lain:</label>
    <input type="text" name="tk_lain_lain" value="{{old('tk_lain_lain',$ucapanSyukur['lain_lain']  ?? '')}}" placeholder="(numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_lain_lain')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

</fieldset>

@if (Auth::user()->role == 'super')
    <label for="temporary" class="block text-black mt-3 font-bold">Verifikasi</label>
    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="temporary" value="1" @if (old('temporary', $jemaat->temporary) == true) {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Belum terverifikasi</span>
    <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="temporary" value="0" @if (old('temporary',$jemaat->temporary) == false) {{"checked"}}@endif />
    <span class="ml-2 text-gray-700">Terverifikasi</span>
    @error('hidup')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
@endif


<script>
    const picker = new Pikaday({
        field: document.getElementById('tanggal_lahir'),
        yearRange: [1900, 2100],
        format: 'DD-MM-YYYY',
    })
    picker.getMoment()
</script>
