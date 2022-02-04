<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'username' => 'required|string|unique:users',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);


        if (User::get()->count() == 0){
            $role = 'editor';
        } else {
            $role = 'reader';
        }

        $user = User::create([
            'username' => $request->username,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);

        $user->sendEmailVerificationNotification();
    }
}
