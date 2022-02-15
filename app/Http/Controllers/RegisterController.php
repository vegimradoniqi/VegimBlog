<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\RegisterRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    private RegisterRepositoryInterface $registerRepository;

    public function __construct(RegisterRepositoryInterface $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }


    public function register(RegisterRequest $request)
    {

        return $this->registerRepository->register($request);
    }

}
