<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data User') }}
        </h2>
    </x-slot>

    <x-succeed-flash />

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <x-back-button :class="'float-right'" :link="url('/user')"/>
                @if ($user->email != "hkidame@mail.com")
                    <form action="{{url('/user/'.$user->id.'/edit')}}" class="float-right">
                        <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                            <span class="material-icons">
                                mode_edit
                            </span>
                            Ubah data
                        </button>
                    </form>
                @else
                    <button class="elative bg-gray-400 text-white border border-gray-700 p-1 px-3 m-1 rounded overflow-hidden cursor-not-allowed float-right">Default User</button>   
                @endif

                <div class="clear-both"></div>

                <p class="text-md font-bold text-blue-500">Nama User</p><p>{{$user->name}}</p><br/>
                <p class="text-md font-bold text-blue-500">Email</p><p>{{$user->email}}</p><br/>
                <p class="text-md font-bold text-blue-500">Sekor</p><p>{{$user->sektor ?? '-'}}</p><br/>
                <p class="text-md font-bold text-blue-500">Role</p><p>{{strtoupper($user->role)}}</p><br/>
                <p class="text-md font-bold text-blue-500">Foto</p>
                @if ($user->foto_profile)
                    <img src="{{asset("storage/image/$user->foto_profile")}}" alt="Foto profile" width="200" height="200" class="my-2" >
                @else
                    Belum mengupload foto
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
