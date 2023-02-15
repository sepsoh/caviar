<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Termwind\terminal;

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


         // this section must be edited

        $registerErrors = [];
        if(request()->input('password') != request()->input('confirm_password'))
            $registerErrors[] = 'Password and confirm password does not match';

        try {
            $user = User::create([
                'name' => request()->input('name') . ' ' . request()->input('lastname'),
                'email' => request()->input('email'),
                'password' => Hash::make(request()->input('password')),
            ]);

//            event(new Registered($user));
//            Auth::login($user);
        } catch (\Exception $e) {

            $registerErrors[] = $e->getCode() == 23000 ? 'Email already exists' : 'Error while registering';
        }


        if(count($registerErrors) > 0){

            return view('register', [
                'registerErrors'=> $registerErrors,
                'registerData'=>[
                    'email'=>request()->input('email') ?? '',
                    'name'=>request()->input('name') ?? '',
                    'lastname'=>request()->input('lastname') ?? '',
                ]]);
        }else{
            return view('login',['email'=> request()->input('email')]);
        }


    }
    public function loginPost(LoginRequest $request)
    {


        $request->authenticate();

        $request->session()->regenerate();
        return redirect('/panel');
        //return redirect()->intended(RouteServiceProvider::HOME);

        /*if (Auth::attempt([
            'email' => request()->input('email'),
            'password' => Hash::make(request()->input('password'))
        ])) {
            dd('you are loged in');
        }else{
            dd('you are not loged in');
        }*/

    }

    public function logout(Request $request){
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
