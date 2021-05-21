<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Baptis / Sidi') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/baptisSidi')"/>
                <form action="{{url('/baptisSidi/'.$baptisSidi->id.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>

                <p class="text-md font-bold text-blue-500">Nama Kepala Keluarga</p><p>{{$keluarga->kepala_keluarga}}</p><br/>
                <p class="text-md font-bold text-blue-500">Alamat Orang Tua</p><p>{{$keluarga->alamat_rumah}}</p><br/>
                <p class="text-md font-bold text-blue-500">Jenis Acara</p><p>{{$baptisSidi->jenis ?? ''}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tanggal {{$baptisSidi->jenis ?? ''}}</p><p>{{$baptisSidi->tanggal ? date("d-m-Y",strToTime($baptisSidi->tanggal)) : '-'}}</p><br/>
                <p class="text-md font-bold text-blue-500">Tempat {{$baptisSidi->jenis ?? ''}}</p><p>{{$baptisSidi->tempat ? $baptisSidi->tempat : '-'}}</p><br/>
                <p class="text-md font-bold text-blue-500">Peserta {{$baptisSidi->jenis ?? ''}}</p>
                    <p>
                        @if (count($pesertas) && $i = 1)
                            @foreach ($pesertas as $peserta)
                                {{$i++.'. '.$peserta->nama. '   ('.$peserta->tempat_lahir.', '.$peserta->tanggal_lahir}})<br/>
                            @endforeach
                        @else
                            -
                        @endif
                    </p><br/>
                <x-ucapan-syukur :ucapanSyukur="$ucapanSyukur"/>
                <br/>
                <div class="clear-both my-5"></div>
                
                @if ($baptisSidi->temporary)
                    <span class="bg-red-500 border-red-600 p-1.5 rounded border-solid font-bold text-white">Tidak Terverifikasi</span>
                @else
                    <span class="bg-green-400 border-green-600 p-1.5 rounded border-solid font-bold text-white">Terverifikasi</span>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
