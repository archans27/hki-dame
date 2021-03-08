<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('master.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\CreateUserRequest $request)
    {
        $user = new User();
        $user = $user->fill($request->all());
        $user->save();
        return redirect('/user')->with('succeed', "User dengan nama $user->name sudah ditambahkan ke database");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('master.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->email == "hkidame@mail.com"){  return redirect('/user')->with('succeed', "Jemaat default tidak boleh ubah");}
        return view('master.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\StoreUserRequest $request, User $user)
    {
        if($request['email'] == "hkidame@mail.com"){  return redirect('/user')->with('succeed', "Jemaat default tidak boleh ubah");}
        if($request['password']){
            $user->password = Hash::make($request['password']);
        }        
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->save();
        
        return redirect('/user')->with('succeed', "User dengan nama $user->name sudah tersimpan ke database");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->email == "hkidame@mail.com"){  return redirect('/user')->with('succeed', "User default tidak dapat dihapus");}
        $user->delete();
        return redirect('/user')->with('succeed', "User dengan nama $user->name sudah dihapus dari database");
    }
}
