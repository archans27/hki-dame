<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Sektor') }}
        </h2>
    </x-slot>

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{url('/sektor/'.$sektor->id)}}" method="post">
                    @method('PUT')
                    @csrf

                    <label for="nama" class="block text-black mt-3 font-bold">Nama Sektor</label>
                    <input type="text" name="nama" value="{{old('nama',$sektor->nama)}}" placeholder="Nama Sekor" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                    @error('nama')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="wilayah" class="block text-black mt-3 font-bold">Wilayah sektor</label>
                    <input type="text" name="wilayah" value="{{old('wilayah',$sektor->wilayah)}}" placeholder="Wilayah sektor" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                    @error('wilayah')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div class="clear-both py-5"></div>

                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>

                    <x-back-button :link="url('/sektor')" />

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
