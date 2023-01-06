<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function login(): Factory|View|Application
    {
        return view('login');
    }
    public function register(): Factory|View|Application
    {
        return view('register');

    }
    public function registerPost()
    {

    }
    public function loginPost()
    {

    }
}
