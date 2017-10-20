<?php

namespace ctf\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use ctf\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        if (!Auth::guest()) {
            return view('user.index', compact('usuario'));
        }
        return view('guest.index');
    }
}
