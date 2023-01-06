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
        if(false){
            return view('login',['email'=> request()->get('email')]);
        }else{
            $registerErrors = [];
            if(request()->get('password') != request()->get('confirm_password'))
                $registerErrors[] = 'Password and confirm password does not match';
            return view('register', [
                'registerErrors'=> $registerErrors,
            'registerData'=>[
                'email'=>request()->get('email') ?? '',
                'name'=>request()->get('name') ?? '',
                'lastname'=>request()->get('lastname') ?? 'Emty',
            ]]);
        }

    }
    public function loginPost()
    {
        return view('login');
    }
}
