<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\RegisterRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterRepository implements RegisterRepositoryInterface
{
    public function register($registerDetails)
    {
        if (User::get()->count() == 0){
            $role = 'editor';
        } else {
            $role = 'reader';
        }

        $user = User::create([
            'username' => $registerDetails->username,
            'firstname' => $registerDetails->firstname,
            'lastname' => $registerDetails->lastname,
            'email' => $registerDetails->email,
            'role' => $role,
            'password' => Hash::make($registerDetails->password),
        ]);

        $user->sendEmailVerificationNotification();

        return response()->json([
            "success" => true,
            "message" => "Registration went successfully, please take a look to your email for completing the verfication."],
        200);
    }
}
