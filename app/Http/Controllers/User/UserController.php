<?php

namespace ctf\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use ctf\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
    // SELECT SUM(flags.pontos) from challenges as flags JOIN challenges_resolvidos as resolvidos on resolvidos.challenges_id=flags.id WHERE flags.pontos=10
        $usuario = Auth::user();
        if (!Auth::guest()) {
            return view('user.index', compact(
                'usuario', 'categorias'
            ));
        }
        return view('guest.index');
    }

    public function news()
    {
        if(!Auth::guest()){
            return view('news.user');            
        }
        return view('news.guest');
    }
}
