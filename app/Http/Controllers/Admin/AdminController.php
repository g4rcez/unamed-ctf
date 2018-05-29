<?php

namespace ctf\Http\Controllers\Admin;

use ctf\Http\Controllers\Controller;
use ctf\Models\Category;
use ctf\Models\Challenge;
use ctf\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $challenges = Challenge::all();
        $categories = Category::all();
        return view('admin.index', compact('users', 'challenges', 'categories'));
    }

}
