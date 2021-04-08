<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Meninggal') }}
        </h2>
    </x-slot>
    
    <x-succeed-flash />

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              
              <form action="{{route('meninggal.create')}}" method="get" class="float-right m-5">
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
                            <th class="px-5 py-2">No</th>
                            <th class="px-5 py-2">Tanggal</th>
                            <th class="px-5 py-2">Nama</th>
                            <th class="px-5 py-2">Umur</th>
                            <th class="px-5 py-2">Alamat</th>
                            <th class="px-5 py-2">Status</th>
                            <th class="px-5 py-2 text-left">Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @php $number = 1; @endphp
                            @foreach ($meninggal as $data)
                              <tr class="bg-white border-4 border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                                <td class="px-5 py-2 text-center" >{{$number++}}</td>
                                <td class="px-5 py-2 text-center">{{date("d-m-Y",strToTime($data->tanggal))}}</td>
                                <td class="px-5 py-2 text-center cursor-pointer font-bold text-blue-500 hover:text-yellow-500" ><a href="{{url('/meninggal/'.$data->id)}}">{{$data->nama}}</a></td>
                                @php 
                                  $diff = abs(strtotime($data->tanggal) - strtotime($data->tanggal_lahir));
                                  $years = floor($diff / (365*60*60*24));
                                @endphp
                                <td class="px-5 py-2 text-center">{{$years}} tahun</td>
                                <td class="px-5 py-2 text-center">{{$data->alamat_rumah}}</td>
                                <td class="px-5 py-2 text-center">
                                  @if ($data->temporary)
                                    <span class="bg-red-400 border-red-600 p-1.5 rounded font-bold text-white">Tidak Terverifikasi</span>
                                  @else
                                  <span class="bg-green-500 border-green-600 p-1.5 rounded font-bold text-white">Terverifikasi</span>
                                  @endif
                                </td>
                                <td class="px-5 py-2 text-left align-middle" >
                                  <form action="{{url('meninggal/'.$data->id.'/edit')}}" class="float-left">
                                    <button type="submit">
                                      <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                        mode_edit
                                      </span>
                                    </button>|
                                  </form>
                                  <form method="post" action="{{url('/meninggal/'.$data->id)}}" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                      onclick="event.preventDefault();
                                        toggleModal('modal-delete');
                                        deletemeninggal('{{url('/meninggal/'.$data->id)}}')"
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
                      {{ $meninggal->links() }}
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
  function deletemeninggal(url){
    document.getElementById('form-modal-delete').setAttribute('action', url);
  }
</script>
