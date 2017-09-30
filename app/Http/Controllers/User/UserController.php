<?php

namespace ctf\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use ctf\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        if(Auth::guest()){
            return view('guest.index');
        }
        $usuario = Auth::user();
        return view('user.index', compact(
            'usuario'
        ));
    }
}
