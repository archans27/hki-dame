<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Data Baptis & Sidi') }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 pb-5">

                <form action="{{route('baptisSidi.update',$baptisSidi->id)}}" method="post">
                    @method('PUT')
                    @csrf


                        <label class="block text-black mt-3 font-bold">Nama Kepala Keluarga</label>
                        <input type="text" value="{{$keluarga->kepala_keluarga}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>

                        <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat Rumah</label>
                        <input type="text" value="{{$keluarga->alamat_rumah}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>

                        <label class="block text-black mt-3 font-bold" for="jenis">Jenis</label>
                        <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="jenis" value="Baptis" @if (old('jenis',$baptisSidi->jenis) == "Baptis") {{"checked"}}@endif />
                        <span class="ml-2 text-gray-700">Baptis</span>
                        <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="jenis" value="Sidi"@if ( old('jenis',$baptisSidi->jenis) == "Sidi") {{"checked"}}@endif />
                        <span class="ml-2 text-gray-700">Sidi</span>
                        @error('jenis')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="tanggal" class="block text-black mt-3 font-bold">Tanggal Acara</label>
                        <input type="text" name="tanggal" id="tanggal" value="{{old('tanggal', $baptisSidi->tanggal ? date("d-m-Y",strToTime($baptisSidi->tanggal)) : '')}}" class="bg-gray-100 rounded-md" autocomplete="off" placeholder="dd-mm-yyyy"/>
                        @error('tanggal')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <table class="table-auto border mt-5">
                            <thead>
                                <tr class="bg-gray-400 text-gray-800 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left w-5">No.</th>
                                    <th class="py-3 px-6 text-left w-40">Nama</th>
                                    <th class="py-3 px-6 text-center w-50">Tempat, Tanggal lahir</th>
                                    <th class="py-3 px-6 text-center w-40">Jenis Kelamin</th>
                                    <th class="py-3 px-6 text-center w-40">Hubungan</th>
                                    <th class="py-3 px-6 text-center w-40">Peserta?</th>
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
                                        <td class="border text-center p-2"><input type="checkbox" name="peserta[]" value="{{$anggotaKeluarga->jemaat_id}}"
                                            @if (in_array($anggotaKeluarga->jemaat_id, $peserta))
                                                checked
                                            @endif
                                        />
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @error('peserta')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

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

                        <label id="label_akta" for="tk_akte" class="block text-black mt-3 font-bold">Ucapan Syukur Pengganti Akte:</label>
                        <input type="text" name="tk_akte" value="{{old('tk_akte',$ucapanSyukur['akte']  ?? '')}}" placeholder="Ucapan Syukur Untuk Akta (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                        @error('tk_akte')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div id="container_tk_pengajar">
                            <label for="tk_tim_pengajar" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Tim Pengajar:</label>
                            <input type="text" name="tk_tim_pengajar" value="{{old('tk_tim_pengajar',$ucapanSyukur['tim_pengajar']  ?? '')}}" placeholder="Ucapan Syukur Untuk Tim Pengajar (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_tim_pengajar')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="tk_lain_lain" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Lainnya:</label>
                        <input type="text" name="tk_lain_lain" value="{{old('tk_lain_lain',$ucapanSyukur['lain_lain']  ?? '')}}" placeholder="Ucapan Syukur Untuk Lainnya (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                        @error('tk_lain_lain')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                    
                    

                    <div class="clear-both px-5 pb-5"></div>
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>
                
                    <x-back-button :link="url('/baptisSidi')" />
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
    let jenis = document.getElementsByName('jenis');
    let label_akta = document.getElementById('label_akta');
    let container_tk_pengajar = document.getElementById('container_tk_pengajar');

    const getJenis = () => {
        jenis.forEach(element => {
            element.addEventListener('change', function() {
                if (element.value == 'Baptis' && element.checked) {
                    label_akta.innerHTML = 'Ucapan Syukur Pengganti Akta Baptis:'
                    container_tk_pengajar.style.display = "none";
                }else{
                    label_akta.innerHTML = 'Ucapan Syukur Pengganti Akta Sidi:'
                    container_tk_pengajar.style.display = "block";
                }
            });
        });
    }

    getJenis();
    var event = new Event('change');
    jenis[0].dispatchEvent(event);



</script>

