@props(['jemaat','ucapanSyukur'])
<fieldset class="border-solid border-blue-500 border-2 px-4 pb-4 mt-5">
    <legend class="px-2 text-lg">Data permohonan jemaat baru:</legend>

    <label for="lampiran" class="block text-black mt-3 font-bold">Melampiran Copy/Asli:</label>
    <input type="text" name="lampiran" value="{{old('lampiran',$jemaat->lampiran  ?? '')}}" placeholder="Surat Pindah, Surat Nikah, Akta Lahir, dll" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('lampiran')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="alamat_jemaat_baru" class="block text-black mt-3 font-bold">Alamat:</label>
    <input type="text" name="alamat_jemaat_baru" value="{{old('alamat_jemaat_baru',$jemaat->alamat_jemaat_baru  ?? '')}}" placeholder="Alamat jemaat baru" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('alamat_jemaat_baru')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="gereja_terakhir" class="block text-black mt-3 font-bold">Terakhir sebagai Anggota/Majelis di Gereja:</label>
    <input type="text" name="gereja_terakhir" value="{{old('gereja_terakhir',$jemaat->gereja_terakhir  ?? '')}}" placeholder="Gereja terakhir" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('gereja_terakhir')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="gereja_lama_lain" class="block text-black mt-3 font-bold">Pernah menjadi Anggota/Majelis di Gereja:</label>
    <input type="text" name="gereja_lama_lain" value="{{old('gereja_lama_lain',$jemaat->gereja_lama_lain  ?? '')}}" placeholder="Gereja lain" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('gereja_lama_lain')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="persembahan_tahunan" class="block text-black mt-3 font-bold">Bersedia memberikan persembahan tahunan minimal:</label>
    <input type="text" name="persembahan_tahunan" value="{{old('persembahan_tahunan',$jemaat->persembahan_tahunan  ?? '')}}" placeholder="Persembahan tahunan minimal (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    <label for="note" class="block text-black mt-1 italic" style="font-size: 12px; ">*Diperuntukkan untuk pengembangan gereja. Minimal Rp. 420.000,- (85% untuk diakonia, 15 % untuk Pembangunan)</label>
    @error('persembahan_tahunan')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</fieldset>

<fieldset class="border-solid border-blue-500 border-2 px-4 pb-4 mt-5">
    <legend class="px-2 text-lg">Data ucapan syukur jemaat baru:</legend>

    <label for="tk_pendeta" class="block text-black mt-3 font-bold">Ucapan syukur untuk Pendeta:</label>
    <input type="text" name="tk_pendeta" value="{{old('tk_pendeta',$ucapanSyukur['pendeta']  ?? '')}}" placeholder="Ucapan syukur untuk Pendeta (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_pendeta')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_guru_huria" class="block text-black mt-3 font-bold">Ucapan syukur untuk Guru Huria:</label>
    <input type="text" name="tk_guru_huria" value="{{old('tk_guru_huria',$ucapanSyukur['guru_huria']  ?? '')}}" placeholder="Ucapan syukur untuk Guru Huria (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_guru_huria')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_gereja" class="block text-black mt-3 font-bold">Ucapan syukur untuk Gereja:</label>
    <input type="text" name="tk_gereja" value="{{old('tk_gereja',$ucapanSyukur['gereja']  ?? '')}}" placeholder="Ucapan syukur untuk Gereja (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_gereja')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_majelis" class="block text-black mt-3 font-bold">Ucapan syukur untuk Majelis:</label>
    <input type="text" name="tk_majelis" value="{{old('tk_majelis',$ucapanSyukur['majelis']  ?? '')}}" placeholder="Ucapan syukur untuk Majelis (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_majelis')
        <div class="text-red-500">{{ $message }}</div>
    @enderror

    <label for="tk_pengembangan" class="block text-black mt-3 font-bold">Ucapan syukur untuk S. Pengembangan:</label>
    <input type="text" name="tk_pengembangan" value="{{old('tk_pengembangan',$ucapanSyukur['pengembangan']  ?? '')}}" placeholder="Ucapan syukur untuk pengembangan (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
    @error('tk_pengembangan')
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

