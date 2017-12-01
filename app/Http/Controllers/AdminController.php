<?php

namespace ctf\Http\Controllers;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
}
