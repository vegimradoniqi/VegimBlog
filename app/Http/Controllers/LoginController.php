<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\LoginRepositoryInterface;


class LoginController extends Controller
{
    private LoginRepositoryInterface $loginRepository;

    public function __construct(LoginRepositoryInterface $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login(LoginRequest $request)
    {
        return $this->loginRepository->login($request);
    }

    public function logout()
    {
       return $this->loginRepository->logout();
    }
    public function checkLogin()
    {
        return $this->loginRepository->checkLogin();
    }
}
