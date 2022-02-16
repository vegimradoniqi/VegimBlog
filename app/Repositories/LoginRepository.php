<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\LoginRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginRepositoryInterface
{
    public function login($loginDetails): JsonResponse
    {
        $user = User::where('username', $loginDetails->username)->first();

        if ($user) {
            if (is_null($user->email_verified_at))
                throw new HttpResponseException(response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'data' => [
                        "username" => array('Email is not verified!')
                    ]
                ]));
        }
        if (Auth::attempt($loginDetails->only('username', 'password'))) {
            //Delete older access tokens
            Auth::user()->tokens()->delete();

            //Create new accesstoken
            $token = Auth::user()->createToken('developer-access')->plainTextToken;

            return response()->json(
                ["success" => true,
                    "token" => $token
                ], 200);
        }
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => [
                "username" => array('The provided credentials are incorrect.')
            ]
        ]));
    }

    public function logout()
    {
        Auth::logout();
    }

    public function checkLogin(): JsonResponse
    {
        if (Auth::check()) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 200);
        }
    }

}
