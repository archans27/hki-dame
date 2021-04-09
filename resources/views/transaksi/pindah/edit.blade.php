<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Data Pindah') }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 pb-5">

                <form action="{{route('pindah.update',$pindah->id)}}" method="post">
                    @method('PUT')
                    @csrf


                        <label class="block text-black mt-3 font-bold">Nama Kepala Keluarga</label>
                        <input type="text" value="{{$keluarga->kepala_keluarga}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>

                        <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat Rumah</label>
                        <input type="text" value="{{$keluarga->alamat_rumah}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>

                        <table class="table-auto border mt-5">
                            <thead>
                                <tr class="bg-gray-400 text-gray-800 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left w-5">No.</th>
                                    <th class="py-3 px-6 text-left w-40">Nama</th>
                                    <th class="py-3 px-6 text-center w-50">Tempat, Tanggal lahir</th>
                                    <th class="py-3 px-6 text-center w-40">Jenis Kelamin</th>
                                    <th class="py-3 px-6 text-center w-40">Hubungan</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($anggotaKeluargas as $anggotaKeluarga)
                                    <tr>
                                        <td class="border text-center p-2">{{$i++}}</td>
                                        <td class="border text-left p-2">{{$anggotaKeluarga->nama}}</td>
                                        <td class="border text-left p-2">{{$anggotaKeluarga->tempat_lahir.', '.$anggotaKeluarga->tanggal_lahir}}</td>
                                        <td class="border text-center p-2">{{$anggotaKeluarga->jenis_kelamin}}</td>
                                        <td class="border text-center p-2">{{$anggotaKeluarga->hubungan}}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        
                        <label for="tempat" class="block text-black mt-3 font-bold">Mereka bermaksud pindah ke</label>
                        <input type="text" id="tempat" name="tempat" value="{{old('tempat', $pindah->tempat)}}" placeholder="HKI Dame Bandung" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autofocus="" />
                        @error('tempat')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="tanggal" class="block text-black mt-3 font-bold">Tanggal:</label>
                        <input id="tanggal" type="text" name="tanggal" value="{{old('tanggal',$pindah->tanggal ? date("d-m-Y",strToTime($pindah->tanggal)) : '')}}" placeholder="dd-mm-yyyy" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        @error('tanggal_lahir')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                    @if (Auth::user()->role == 'super')
                        <label for="temporary" class="block text-black mt-3 font-bold">Verifikasi</label>
                        <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="temporary" value="1" @if (old('temporary', $pindah->temporary) == true) {{"checked"}}@endif />
                        <span class="ml-2 text-gray-700">Belum terverifikasi</span>
                        <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="temporary" value="0" @if (old('temporary', $pindah->temporary) == false) {{"checked"}}@endif />
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
                
                    <x-back-button :link="url('/pindah')" />
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
</script>