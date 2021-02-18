<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Jemaat') }}
        </h2>
    </x-slot>

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <x-form-jemaat :jemaat="$jemaat" :formAction="url('/jemaat/'.$jemaat->id)" :method="'PUT'"/>
                
            </div>
        </div>
    </div>
</x-app-layout>