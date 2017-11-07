<?php

namespace ctf\Http\Controllers\Challs;

use Request;
use ctf\Models\Challenge;
use ctf\Models\Category;
use ctf\Http\Requests\ChallsRequest;
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
        $categorias = Category::all();
        return view('challenges.index_user', compact('categorias'));
    }

    public function adminCreateView()
    {
        $categorias = Category::all();
        if($categorias->count() == 0){
            \Session::flash('zeroCategorias', "Não há nenhuma categoria cadastrada");
        }
        return view('challenges.create', compact('categorias'));
    }

    public function createFlag(ChallsRequest $request){
        $this->challenge->fill($request->all());
        $this->challenge->flag = hash("sha256", $request->flag);
    }

    public function create(CategoryRequest $request)
    {
        $this->category->fill($request->all());
        if (!$this->category->save()) {
            abort(503, 'Erro ao salvar a categoria.');
        }
        $novaCategoria = $this->category->nome;
        \Session::flash('nova', "A categoria $novaCategoria foi criada com sucesso");
        return \Redirect::route('categorias', compact('novaCategoria'));
    }
}
