<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function root(): View|Factory|Application
    {
        return view('home');
    }

    public function search() : View|Factory|Application
    {
        return view('home',['query'=>\request()->get('query')]);
    }
}
