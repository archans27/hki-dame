<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Jemaat') }}
        </h2>
    </x-slot>

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                          <tr class="bg-gray-800 text-white">
                            <th class="px-16 py-2">Nama jemaat</th>
                            <th class="px-16 py-2">Tanggal lahir</th>
                            <th class="px-16 py-2">Jenis kelamin</th>
                            <th class="px-16 py-2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($jemaats as $jemaat)
                              <tr class="bg-white border-4 border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                                <td class="px-16 py-2 flex flex-row text-center cursor-pointer" ><a href="#">{{$jemaat->nama}}</a></td>
                                <td class="px-16 py-2 text-center">{{$jemaat->tanggal_lahir}}</td>
                                <td class="px-16 py-2 text-center">{{$jemaat->jenis_kelamin}}</td>
                                <td class="px-16 py-2 text-center align-middle" >
                                    <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                    mode_edit
                                    </span> | 
                                    <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                    delete
                                    </span>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>