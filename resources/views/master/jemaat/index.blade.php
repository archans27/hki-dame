<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Jemaat') }}
        </h2>
    </x-slot>
    
    <x-succeed-flash />

    <div class="py-5" style="clear:both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
              
              <div>

              </div>
              <form action="{{route('jemaat.index')}}" method="get" class="float-left mx-0 mb-2 p-5 bg-gray-200 sm:w-full">
                <div class="block">
                  <div class="float-left mr-4">
                    <label for="search" class="block text-black font-bold">Pencarian Nama</label>
                    <input type="text" name="search" value="{{old('search',$filter->search)}}" placeholder="Pencarian" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-60"/> 
                  </div>
                  

                  <div class="float-left mr-4">
                    <label for="golongan_darah" class="block text-black font-bold  mr-2">Golongan Darah</label>
                    <select name="golongan_darah" class="w-40 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                      <option value="">Semua</option>
                      <option @if (old('golongan_darah', $filter->golongan_darah) == "A") {{"selected"}}@endif value="A" >A</option>
                      <option @if (old('golongan_darah', $filter->golongan_darah) == "B") {{"selected"}}@endif value="B" >B</option>
                      <option @if (old('golongan_darah', $filter->golongan_darah) == "AB") {{"selected"}}@endif value="AB" >AB</option>
                      <option @if (old('golongan_darah', $filter->golongan_darah) == "O") {{"selected"}}@endif value="O" >O</option>
                    </select>
                  </div>

                  <div class="float-left mr-4">
                    <label for="month" class="block text-black font-bold  mr-2">Bulan Lahir</label>
                    <select name="month" class="w-40 h-10 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                      <option value="">Semua</option>
                      <option @if (old('month', $filter->month) == "01") {{"selected"}}@endif value="01" >Januari</option>
                      <option @if (old('month', $filter->month) == "02") {{"selected"}}@endif value="02" >Februari</option>
                      <option @if (old('month', $filter->month) == "03") {{"selected"}}@endif value="03" >Maret</option>
                      <option @if (old('month', $filter->month) == "04") {{"selected"}}@endif value="04" >April</option>
                      <option @if (old('month', $filter->month) == "05") {{"selected"}}@endif value="05" >Mei</option>
                      <option @if (old('month', $filter->month) == "06") {{"selected"}}@endif value="06" >Juni</option>
                      <option @if (old('month', $filter->month) == "07") {{"selected"}}@endif value="07" >Juli</option>
                      <option @if (old('month', $filter->month) == "08") {{"selected"}}@endif value="08" >Agustus</option>
                      <option @if (old('month', $filter->month) == "09") {{"selected"}}@endif value="09" >September</option>
                      <option @if (old('month', $filter->month) == "10") {{"selected"}}@endif value="10" >Oktober</option>
                      <option @if (old('month', $filter->month) == "11") {{"selected"}}@endif value="11" >November</option>
                      <option @if (old('month', $filter->month) == "12") {{"selected"}}@endif value="12" >Desember</option>
                    </select>
                  </div>

                  <div class="float-left mr-4">
                    <label for="year" class="block text-black font-bold  mr-2">Tahun Lahir</label>
                    <input type="text" name="year" value="{{old('year',$filter->year)}}" placeholder="{{now()->year}}" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-60 "/>  
                  </div>

                </div>

                <div class="block clear-both">
                  <div class="float-left mr-4">
                    <label for="order_from" class="block text-black font-bold mt-3 mr-2">Urut berdasarkan</label>
                    <select name="order_from" class="w-40 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                      <option @if (old('order_from', $filter->order_from) == "nama") {{"selected"}}@endif value="nama" >Nama</option>
                      <option @if (old('order_from', $filter->order_from) == "tanggal_lahir") {{"selected"}}@endif value="tanggal_lahir" >Tanggal Lahir</option>
                    </select>
                  </div>
                  <div class="float-left mr-4">
                    <label for="order_by" class="block text-black font-bold mt-3 mr-2">Urut secara</label>
                    <select name="order_by" class="w-40 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                      <option @if (old('order_by', $filter->order_by) == "asc") {{"selected"}}@endif value="asc" >Ascending</option>
                      <option @if (old('order_by', $filter->order_by) == "desc") {{"selected"}}@endif value="desc" >Descending</option>
                    </select>
                  </div>

                </div>

                <div class='mt-10 float-right relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                  <button type="submit">Cari</button>
                </div>
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
                    <table class="min-w-full table-auto text-left">
                      <caption><p class="text-left pb-2">Terdapat {{$jemaats->total()}} hasil dari data jemaat<br /></p></caption>
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
                                <td class="px-16 py-2 text-center">{{date("d-m-Y",strToTime($jemaat->tanggal_lahir))}}</td>
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
