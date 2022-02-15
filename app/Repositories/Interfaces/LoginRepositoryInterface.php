<?php


namespace App\Repositories\Interfaces;


interface LoginRepositoryInterface
{
    public function login($loginDetails);

    public function logout();

    public function checkLogin();
}
