<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//use illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
    $request->request->add(['username'=> Str::slug($request->username, '-')]);
    $request->validate([
        'name'=>'required|min:5',
        'username'=>'required|unique:users|min:6|max:16',
        'email'=>'required|unique:users|email|max:60',
        'password'=>'required|confirmed|min:6' 
    ]);
      
        User::create([
            'name' => $request->name,
            'username'=> $request->username,
            'email' => $request->email,
            //'password' => Hash::make( $request->password )
            'password' => $request->password
        ]);

        Auth()->attempt(['email' => $request->email, 'password' => $request->password]);
        //Auth()->attempt($request->only('email', 'password'));

      return redirect()->route('posts.index', auth()->user()->username);

    }


}
