<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Keluarga') }}
        </h2>
    </x-slot>

    <x-succeed-flash />


    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/keluarga')"/>

                <!-- Tombol Ubah Data -->
                <form action="{{url('/keluarga/'.$keluargas[0]->keluarga_id.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>

                <!-- Tombol Export to PDF -->
                <form action="{{ route('generate-pdf-detail-keluarga', ['keluarga' => $keluargas[0]->keluarga_id]) }}" method="GET" target="_blank" class="float-right">
                    <button type="submit" class="relative bg-red-500 text-white border border-red-500 p-1 px-3 m-1 rounded overflow-hidden">
                        <span class="material-icons">
                            download
                        </span>
                        Export to PDF
                    </button>
                </form>


                <div class="clear-both"></div>
    </div>



                <p class="text-md font-bold text-blue-500">Nama Kepala Keluarga</p><p>{{$keluargas[0]->kepala_keluarga}}</p><br/>
                <p class="text-md font-bold text-blue-500">No. Keluarga</p><p>{{$keluargas[0]->no_keluarga}}</p><br/>
                <p class="text-md font-bold text-blue-500">Sektor</p><p>{{$keluargas[0]->nama_sektor}}</p><br/>
                <p class="text-md font-bold text-blue-500">Alamat</p><p>{{$keluargas[0]->alamat_keluarga}}</p><br/>
                <p class="text-md font-bold text-blue-500">Status Rumah</p><p>{{$keluargas[0]->status_rumah}}</p><br/>
                {{-- Table Keluarga --}}
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                          <tr class="bg-gray-800 text-white">
                            <th class="px-5 py-2 text-left">Nama Anggota Keluarga</th>
                            <th class="px-5 py-2">Hubungan Dalam Keluarga</th>
                            <th class="px-5 py-2">Jenis Kelamin</th>
                            <th class="px-5 py-2">Tanggal Lahir</th>
                          </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($keluargas as $keluarga)
                              <tr class="bg-white border-4 border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                                <td class="px-5 py-2 text-left text-blue-500"><a href="{{url('/jemaat/'.$keluarga->jemaat_id)}}"> {{$keluarga->nama}}</a></td>
                                <td class="px-5 py-2 text-center">{{$keluarga->hubungan}}</td>
                                <td class="px-5 py-2 text-center">{{$keluarga->jenis_kelamin}}</td>
                                <td class="px-5 py-2 text-center">{{date("d-m-Y",strToTime($keluarga->tanggal_lahir))}}</td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
