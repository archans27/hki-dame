<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Jemaat') }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{url('/jemaatBaru/'.$jemaat->idJemaatBaru)}}" method="post">
                    @method('PUT')
                    @csrf

                    <fieldset class="border-solid border-blue-500 border-2 px-4 pb-4">
                        <legend class="px-2 text-lg">Data utama Jemaat:</legend>
                        <x-form-jemaat :jemaat="$jemaat" :sektors="$sektors" />
                    </fieldset>
                    <x-form-jemaat-baru :jemaat="$jemaat" :ucapanSyukur="$ucapanSyukur"/>

                    

                    <div class="clear-both px-5 pb-5"></div>
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>
                
                    <x-back-button :link="url('/jemaatBaru')" />
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>
