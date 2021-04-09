<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data User') }}
        </h2>
    </x-slot>

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <form action="{{url('/user/'.$user->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <label for="name" class="block text-black mt-3 font-bold">Nama User</label>
                    <input id="name" type="text" name="name" value="{{old('name',$user->name)}}" placeholder="Nama User" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                    <div class="row z-10" id="match-list"></div>
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="email" class="block text-black mt-3 font-bold">Email User</label>
                    <input id="email" type="text" name="email" value="{{old('email',$user->email)}}" placeholder="Email User" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                    <div class="row z-10" id="match-list"></div>
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="sektor_id" class="block text-black mt-3 font-bold">Sektor</label>
                    <select name="sektor_id" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Sektor">
                        @foreach ($sektors as $sektor)
                            <option @if (old('sektor_id', $user->sektor_id) == $sektor->id) {{"selected"}}@endif value="{{$sektor->id}}" >{{$sektor->nama}}</option>
                        @endforeach
                    </select>
                    @error('sektor_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="role" class="block text-black mt-3 font-bold">Role</label>
                    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="role" value="super" @if (old('role', $user->role) == "super") {{"checked"}}@endif />
                    <span class="ml-2 text-gray-700">SUPER</span>
                    <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="role" value="admin" @if (old('role',$user->role) == "admin") {{"checked"}}@endif />
                    <span class="ml-2 text-gray-700">ADMIN</span>
                    @error('role')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <hr class="border-solid mt-5 border-2" />

                    <label for="password" class="block text-black mt-3 font-bold">Password</label>
                    <input id="password" type="password" name="password" value="" placeholder="********" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                    <div class="row z-10" id="match-list"></div>
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="password_confirmation" class="block text-black mt-3 font-bold">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" value="" placeholder="********" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                    <div class="row z-10" id="match-list"></div>
                    @error('password_confirmation')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    @if ($user->foto_profile)
                        <img src="{{asset("storage/image/$user->foto_profile")}}" alt="Foto profile" width="200" height="200" class="my-2" >
                    @endif
                    <label for="foto_profile" class="block text-black mt-3 font-bold">Foto User</label>
                    <input type="file" id="foto_profile" name="foto_profile" />
                    @error('foto_profile')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div class="clear-both py-5"></div>

                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>

                    <x-back-button :link="url('/user')" />

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
