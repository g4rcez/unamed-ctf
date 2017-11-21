<?php

namespace ctf\Http\Controllers\Challs;

use Auth;
use ctf\Models\ChallengesResolvido;
use Request;
use ctf\Models\Challenge;
use ctf\Models\Category;
use ctf\Http\Requests\ChallsRequest;
use ctf\Http\Controllers\Controller;


class ChallengesController extends Controller
{

    private $challenge;

    public function __construct(Challenge $challenge)
    {
        $this->challenge = $challenge;
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

    public function adminCreateView(Category $category)
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

    public function submitFlag(ChallengesResolvido $challengesResolvido){
        $assert = $this->challenge->where("flag", hash("sha256", Request::input("flag")));
//        dd($assert->count());
        if ($assert->count() == 1){
            $values = ['users_id' => Auth::user()->id,
                'challenges_id' => $assert->first()->id
            ];
            $challengesResolvido->fill($values);
            $resolvido = ChallengesResolvido::all()->where(
                'challenges_id',$values['challenges_id']
            )->where('users_id',$values['users_id']);

            if($resolvido->count() == 0){
                $challengesResolvido->saveOrFail();
                $flagCaptured = $assert->first()->nome;
                \Session::flash('flagCaptured', "Você capturou a flag: $flagCaptured");
                return redirect()->route("challs");
            }
            return "Você já resolveu essa porra";
        }
        return "Deu ruim";
    }

    public function delete($nome, $id)
    {
        $challenge = $this->challenge->findOrFail($id)->where('nome', $nome)->first();
        if(!$challenge->delete()){
            abort(500);
        }
        \Session::flash('deletado', "A categoria $nome foi deletada com sucesso");
        return redirect()->route('adminChall');
    }

    public function viewUpdate($nome, $id)
    {
        $challenge = Challenge::all()->where('nome', $nome)->where('id', $id)->first();
        return view('challenge.edit', compact('challenge'));
    }

    public function update(CategoryRequest $request, $nome, $id)
    {
        $updated = Challenge::all()->find($id);
        $updated->update($request->all());
        $novo = $request->input('nome');
        \Session::flash('atualizado', "A categoria $nome foi atualizada para $novo");
        return \Redirect::route('adminChall');
    }
}
