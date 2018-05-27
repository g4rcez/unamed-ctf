<?php

namespace ctf\Http\Controllers\Admin;
use ctf\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

}
