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
        $challenges = Challenge::all();
        return view('challenges.index_user', compact('challenges'));
    }

    public function adminView(){
        $challenges = Challenge::all();
        return view('challenges.index', compact('challenges'));
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
        $this->challenge->categories_id = $request->categories_id;
        if(!$this->challenge->save()){
            abort(500, 'Erro ao salvar a categoria.');
        }
        $challenge = $this->challenge->nome;
        \Session::flash('nova', "A categoria $challenge foi criada com sucesso");
        return redirect()->route('adminChall', compact('challenge'));
    }

    public function submitFlag(){
        $assert = $this->challenge->where("flag", hash("sha256", Request::input("flag")));
        if ($assert->count() == 1){
            $flagCaptured = $assert->first()->nome;
            \Session::flash('flagCaptured', "Você capturou a flag: $flagCaptured");
            return redirect()->route("challs");
        }
        return "Deu ruim";
    }
}
