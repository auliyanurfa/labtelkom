<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users', [
            "title" => "Users",
            "users" => User::all(),
            "date" =>Carbon::parse()->isoFormat('LLLL'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.index', [
            "title" => "addUser",
            "roles" => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'NIP' => 'required|numeric|min:18',
            'username' => 'required|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'address' => 'required',
            'role_id' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/BHP/user')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user,
            'title' => 'detail',
            'roles' => Role::where('id', $user->role_id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'title' => 'Edit',
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData=$request->validate([
            'name' => 'required|max:255',
            'NIP' => 'required|numeric|min:18',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'address' => 'required',
            'role_id' => 'required',    
        ]);   

        User::where('id', $user->id)->update($validatedData);
        return redirect('/BHP/user')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('BHP/user')-> with('success', 'Data User berhasil di hapus!');
    }
}
