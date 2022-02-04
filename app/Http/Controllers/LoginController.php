<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use function Composer\Autoload\includeFile;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            "username" => 'required',
            "password" => 'required'
        ]);
        $user = User::where('username', $request->username)->first();
        if ($user) {
            if (is_null($user->email_verified_at))
            throw ValidationException::withMessages([
                'username' => 'Email is not verified !'
            ]);
        }
        if (Auth::attempt($request->only('username', 'password'))) {
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'username' => 'The provided credentials are incorrect.'
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }
    public function checkLogin()
    {
        if (Auth::check()){
            return response()->json(['success'=>true],200);
        } else {
            return response()->json(['success'=>false],200);
        }
    }
}
