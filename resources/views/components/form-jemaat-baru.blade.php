@props(['jemaat'])

<label for="alamat_jemaat_baru" class="block text-black mt-3 font-bold">Alamat:</label>
<input type="text" name="alamat_jemaat_baru" value="{{old('alamat_jemaat_baru',$jemaat->alamat_jemaat_baru  ?? '')}}" placeholder="Alamat jemaat baru" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('alamat_jemaat_baru')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="gereja_terkahir" class="block text-black mt-3 font-bold">Terakhir sebagai Anggota/Majelis di Gereja:</label>
<input type="text" name="gereja_terkahir" value="{{old('gereja_terkahir',$jemaat->gereja_terkahir  ?? '')}}" placeholder="Gereja terakhir" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('gereja_terkahir')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="gereja_lama_lain" class="block text-black mt-3 font-bold">Pernah menjadi Anggota/Majelis di Gereja:</label>
<input type="text" name="gereja_lama_lain" value="{{old('gereja_lama_lain',$jemaat->gereja_lama_lain  ?? '')}}" placeholder="Gereja lain" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('gereja_lama_lain')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="persembahan_tahunan" class="block text-black mt-3 font-bold">Bersedia memberikan persembahan tahunan minimal:</label>
<input type="text" name="persembahan_tahunan" value="{{old('persembahan_tahunan',$jemaat->persembahan_tahunan  ?? '')}}" placeholder="Persembahan tahunan minimal (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
@error('persembahan_tahunan')
    <div class="text-red-500">{{ $message }}</div>
@enderror

{{-- SUDAH ADA DI DATA UTAMA JEMAAT
    <label for="tanggal_jemaat_baru" class="block text-black mt-3 font-bold">Menjadi anggota HKI dengan sukarela serta berdasarkan keyakinan sendiri pada tanggal:</label>
<input type="text" id="tanggal_jemaat_baru" name="tanggal_jemaat_baru  ?? ''" value="{{old('tanggal_jemaat_baru',$jemaat->tanggal_jemaat_baru)}}" placeholder="Tanggal lahir" class="bg-gray-100 rounded-md" autocomplete="off" />
@error('tanggal_jemaat_baru')
    <div class="text-red-500">{{ $message }}</div>
@enderror
<script>
    const pickerTanggalJemaatBaru = new Pikaday({
        field: document.getElementById('tanggal_jemaat_baru'),
        yearRange: [1900, 2100],
        format: 'DD-MM-YYYY',
    })
    pickerTanggalJemaatBaru.getMoment()
</script>
--}}