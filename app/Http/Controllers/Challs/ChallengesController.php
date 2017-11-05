<?php

namespace ctf\Http\Controllers\Challs;

use Request;
use ctf\Models\Challenge;
use ctf\Models\Category;
use ctf\Http\Controllers\Controller;


class ChallengesController extends Controller
{

    private $challenge;
    private $category;

    public function __construct(Challenge $challenge, Category $category)
    {
        $this->challenge = $challenge;
        $this->category = $category;
    }

    public function userView()
    {
        return view('challenges.index_user');
    }

    public function adminCreateView()
    {
        $categorias = Category::all();

        if($categorias->count() == 0){
            \Session::flash('zeroCategorias', "Não há nenhuma categoria cadastrada");
        }
        return view('challenges.create', compact('categorias'));
    }
}
