<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Jemaat') }}
        </h2>
    </x-slot>
    
    <x-succeed-flash />

    <div class="py-5" style="clear:both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              
              <form action="{{route('jemaat.index')}}" method="get" class="float-left m-5">
                <label for="search" class="block text-black mt-3 font-bold float-left mr-2">Pencarian</label>
                <input type="text" name="search" value="{{old('search',$filter->search)}}" placeholder="Pencarian" class="float-right rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-60 sm:w-full"/>                
              </form>

              
              <form action="{{route('jemaat.create')}}" method="get" class="float-right m-5">
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
                            <th class="px-16 py-2">Nama jemaat</th>
                            <th class="px-16 py-2">Tanggal lahir</th>
                            <th class="px-16 py-2">Jenis kelamin</th>
                            <th class="px-16 py-2 text-left">Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($jemaats as $jemaat)
                              <tr class="bg-white border-4 border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                                <td class="px-16 py-2 flex flex-row text-center cursor-pointer font-bold text-blue-500 hover:text-yellow-500" ><a href="{{url('/jemaat/'.$jemaat->id)}}">{{$jemaat->nama}}</a></td>
                                <td class="px-16 py-2 text-center">{{$jemaat->tanggal_lahir}}</td>
                                <td class="px-16 py-2 text-center">{{$jemaat->jenis_kelamin}}</td>
                                <td class="px-16 py-2 text-left align-middle" >
                                  <form action="{{url('jemaat/'.$jemaat->id.'/edit')}}" class="float-left">
                                    <button type="submit">
                                      <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                        mode_edit
                                      </span>
                                    </button>|
                                  </form>
                                  <form method="post" action="{{url('/jemaat/'.$jemaat->id)}}" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                      onclick="event.preventDefault();
                                        toggleModal('modal-delete');
                                        deleteJemaat('{{url('/jemaat/'.$jemaat->id)}}')"
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
                      {{ $jemaats->links() }}
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
  function deleteJemaat(url){
    document.getElementById('form-modal-delete').setAttribute('action', url);
  }
</script>
