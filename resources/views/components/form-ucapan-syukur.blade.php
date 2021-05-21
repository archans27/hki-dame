@props(['ucapanSyukur'])

<label for="tk_gereja" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Gereja:</label>
<input type="text" name="tk_gereja" value="{{old('tk_gereja',$ucapanSyukur['gereja']  ?? '')}}" placeholder="Ucapan Syukur Untuk Gereja (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
@error('tk_gereja')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="tk_majelis" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Majelis:</label>
<input type="text" name="tk_majelis" value="{{old('tk_majelis',$ucapanSyukur['majelis']  ?? '')}}" placeholder="Ucapan Syukur Untuk Majelis (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
@error('tk_majelis')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="tk_pendeta" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Pendeta:</label>
<input type="text" name="tk_pendeta" value="{{old('tk_pendeta',$ucapanSyukur['pendeta']  ?? '')}}" placeholder="Ucapan Syukur Untuk Pendeta (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
@error('tk_pendeta')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="tk_guru_huria" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Guru Huria:</label>
<input type="text" name="tk_guru_huria" value="{{old('tk_guru_huria',$ucapanSyukur['guru_huria']  ?? '')}}" placeholder="Ucapan Syukur Untuk Guru Huria (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
@error('tk_guru_huria')
    <div class="text-red-500">{{ $message }}</div>
@enderror

<label for="tk_pembangunan" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Pembangunan:</label>
<input type="text" name="tk_pembangunan" value="{{old('tk_pembangunan',$ucapanSyukur['pembangunan']  ?? '')}}" placeholder="Ucapan Syukur Untuk Pembangunan (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
@error('tk_pembangunan')
    <div class="text-red-500">{{ $message }}</div>
@enderror