<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Sintua`') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/sintua')"/>
                <form action="{{url('/sintua/'.$sintua->id.'/edit')}}" class="float-right">
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            mode_edit
                        </span>
                        Ubah data
                    </button>
                </form>
                <div class="clear-both"></div>

                <p class="text-md font-bold text-blue-500">Nama Sintua</p><p>{{$sintua->nama}}</p><br/>
                <p class="text-md font-bold text-blue-500">Sektor</p><p>{{$sintua->nama_sektor}}</p><br/>
            </div>
        </div>
    </div>
</x-app-layout>
