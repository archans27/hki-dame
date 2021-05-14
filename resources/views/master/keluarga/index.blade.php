<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Keluarga') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{route('keluarga.index')}}" method="get" class="float-left mx-0 mb-2 p-5 bg-gray-200 sm:w-full">
                    <div class="block">
                        <div class="float-left mr-4">
                            <label for="search" class="block text-black font-bold">Pencarian Nama</label>
                            <input type="text" name="search" value="{{old('search',$filter->search)}}" placeholder="Pencarian" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-60"/>
                        </div>

                        <div class="float-left mr-4">
                            <label for="sector" class="block text-black font-bold  mr-2">Sektor</label>
                            <select name="sector" class="w-40 h-10 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Sektor">
                            <option @if (old('sector', $filter->sector) == 1) {{"selected"}}@endif value=0 >Semua</option>
                            <option @if (old('sector', $filter->sector) == 1) {{"selected"}}@endif value=1 >Sektor 01</option>
                            <option @if (old('sector', $filter->sector) == 2) {{"selected"}}@endif value=2 >Sektor 02</option>
                            <option @if (old('sector', $filter->sector) == 3) {{"selected"}}@endif value=3 >Sektor 03</option>
                            <option @if (old('sector', $filter->sector) == 4) {{"selected"}}@endif value=4 >Sektor 04</option>
                            <option @if (old('sector', $filter->sector) == 5) {{"selected"}}@endif value=5 >Sektor 05</option>
                            <option @if (old('sector', $filter->sector) == 6) {{"selected"}}@endif value=6 >Sektor 06</option>
                            <option @if (old('sector', $filter->sector) == 7) {{"selected"}}@endif value=7 >Sektor 07</option>
                            <option @if (old('sector', $filter->sector) == 8) {{"selected"}}@endif value=8 >Sektor 08</option>
                            <option @if (old('sector', $filter->sector) == 9) {{"selected"}}@endif value=9 >Sektor 09</option>
                            <option @if (old('sector', $filter->sector) == 10) {{"selected"}}@endif value=10 >Sektor 10</option>
                            <option @if (old('sector', $filter->sector) == 11) {{"selected"}}@endif value=11 >Sektor 11</option>
                            <option @if (old('sector', $filter->sector) == 12) {{"selected"}}@endif value=12 >Sektor 12</option>
                            <option @if (old('sector', $filter->sector) == 13) {{"selected"}}@endif value=13 >Sektor 13</option>
                        </select>
                      </div>
                    </div>

                    <div class="block clear-both">
                      <div class="float-left mr-4">
                        <label for="order_from" class="block text-black font-bold mt-3 mr-2">Urut berdasarkan</label>
                        <select name="order_from" class="w-60 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Urut berdasarkan">
                          <option @if (old('order_from', $filter->order_from) == "kepala_keluarga") {{"selected"}}@endif value="kepala_keluarga" >Kepala Keluarga</option>
                          <option @if (old('order_from', $filter->order_from) == "no_keluarga") {{"selected"}}@endif value="no_keluarga" >Nomor Keluarga</option>
                        </select>
                      </div>
                      <div class="float-left mr-4">
                        <label for="order_by" class="block text-black font-bold mt-3 mr-2">Urut secara</label>
                        <select name="order_by" class="w-60 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                          <option @if (old('order_by', $filter->order_by) == "asc") {{"selected"}}@endif value="asc" >Ascending</option>
                          <option @if (old('order_by', $filter->order_by) == "desc") {{"selected"}}@endif value="desc" >Descending</option>
                        </select>
                      </div>
                    </div>

                    <div class='mt-10 float-right relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                      <button type="submit">Cari</button>
                    </div>
                  </form>

              <form action="{{route('keluarga.create')}}" method="get" class="float-right m-5">
                <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                    <span class="material-icons">
                        add
                    </span>
                    Tambah data
                </button>
              </form>

                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                      <caption><p class="text-left pb-2">Terdapat {{$keluargas->total()}} hasil dari data keluarga<br /></p></caption>
                        <thead class="justify-between">
                          <tr class="bg-gray-800 text-white">
                            <th class="px-16 py-2 text-left">Nama Kepala Keluarga</th>
                            <th class="px-16 py-2">Sektor</th>
                            <th class="px-16 py-2 text-left">Aksi</th>
                          </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($keluargas as $keluarga)
                              <tr class="bg-white border-4 border-gray-200 items-center text-gray-700 hover:bg-gray-200">
                                <td class="px-16 py-2 flex flex-row text-left cursor-pointer font-bold text-blue-500 hover:text-yellow-500" ><a href="{{url('/keluarga/'.$keluarga->id)}}">{{$keluarga->kepala_keluarga}}</a></td>
                                <td class="px-16 py-2 text-center"> {{$keluarga->nama_sektor}}</td>
                                <td class="px-16 py-2 text-left align-middle" >
                                  <form action="{{url('keluarga/'.$keluarga->id.'/edit')}}" class="float-left">
                                    <button type="submit">
                                      <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                        mode_edit
                                      </span>
                                    </button>
                                  </form>
                                  {{-- <form method="post" action="{{url('/keluarga/'.$keluarga->id)}}" class="float-left">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                      onclick="event.preventDefault();
                                        toggleModal('modal-delete');
                                        deleteKeluarga('{{url('/keluarga/'.$keluarga->id)}}')"
                                    >
                                      <span class="material-icons cursor-pointer text-gray-500 hover:text-blue-500">
                                        delete
                                        </span>
                                    </button>
                                  </form> --}}
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
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
  function deleteKeluarga(url){
    document.getElementById('form-modal-delete').setAttribute('action', url);
    console.log(url);
  }
</script>
