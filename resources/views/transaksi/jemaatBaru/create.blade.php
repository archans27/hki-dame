<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Data Jemaat Baru') }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{route('jemaatBaru.store')}}" method="post">
                    @method('POST')
                    @csrf

                    <fieldset class="border-solid border-blue-500 border-2 px-4 pb-4">
                        <legend class="px-2 text-lg">Data utama Jemaat:</legend>
                        <x-form-jemaat :jemaat="$jemaat" :sektors="$sektors" />
                    </fieldset>
                    <x-form-jemaat-baru :jemaat="$jemaat" />

                    

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