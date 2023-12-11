<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kelahiran/Angkat Anak') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{ route('jemaatLahir.index') }}" method="get" class="float-left m-5">
                    <!-- Tambahkan ini pada bagian formulir pencarian -->
                    <div class="float-left mr-4">
                        <label for="search_year" class="block text-black font-bold mr-2">Tahun Input</label>
                        <input type="text" name="search_year" value="{{ old('search_year', $filter->search_year) }}" placeholder="Tahun Input" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-60" />
                        <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded align-middle overflow-hidden'>
                            Cari
                        </button>
                    </div>
                </form>
              <form action="{{route('jemaatLahir.create')}}" method="get" class="float-right m-5">
                <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                    <span class="material-icons">
                        add
                    </span>
                    Tambah data
                </button>
              </form>

                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                          <tr class="bg-gray-800 text-white">
                            <th class="px-16 py-2">Nama Kepala Keluarga</th>
                            <th class="px-16 py-2">Nama Anak</th>
                            <th class="px-5 py-2">Tanggal Input</th>
                            <th class="px-5 py-2">Sektor</th>
                            <th class="px-16 py-2">Status</th>
                            <th class="px-16 py-2 text-left">Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($jemaatLahirs as $jemaatLahir)
                              <tr class="bg-white border-4 border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                                <td class="px-16 py-2 flex flex-row text-center cursor-pointer font-bold text-blue-500 hover:text-yellow-500" ><a href="{{url('/jemaatLahir/'.$jemaatLahir->idJemaatLahir)}}">{{$jemaatLahir->nama_kepala_keluarga}}</a></td>
                                <td class="px-16 py-2 text-center">{{$jemaatLahir->nama}}</td>
                                <td class="p-2 text-center">{{$jemaatLahir->created_at ? date("d-m-Y",strToTime($jemaatLahir->created_at)) : '-'}}</td>
                                <td class="p-2 text-center">{{$jemaatLahir->sektor_id}}</td>
                                <td class="px-16 py-2 text-center">
                                  @if ($jemaatLahir->temporary)
                                    <span class="bg-red-400 border-red-600 p-1.5 rounded font-bold text-white">Tidak Terverifikasi</span>
                                  @else
                                  <span class="bg-green-500 border-green-600 p-1.5 rounded font-bold text-white">Terverifikasi</span>
                                  @endif
                                </td>
                                <td class="px-16 py-2 text-left align-middle" >
                                  <form action="{{url('jemaatLahir/'.$jemaatLahir->idJemaatLahir.'/edit')}}" class="float-left">
                                    <button type="submit">
                                      <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                        mode_edit
                                      </span>
                                    </button>|
                                  </form>
                                  <form method="post" action="{{url('/jemaatLahir/'.$jemaatLahir->idJemaatLahir)}}" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                      onclick="event.preventDefault();
                                        toggleModal('modal-delete');
                                        deletejemaatLahir('{{url('/jemaatLahir/'.$jemaatLahir->idJemaatLahir)}}')"
                                    >
                                      <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                        delete
                                        </span>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <br/>
                      {{ $jemaatLahirs->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-popup-confirm
      :modalId="'modal-delete'"
      :formId="'form-modal-delete'"
      :title="'Delete Data'"
      :message="'Apakah anda yakin akan menghapus data ini?'"
      :action="'Hapus data'"
      :actionUrl="url('/')"
      :actionMethod="'DELETE'"
    />
</x-app-layout>

<script>
  function deletejemaatLahir(url){
    document.getElementById('form-modal-delete').setAttribute('action', url);
  }
</script>
