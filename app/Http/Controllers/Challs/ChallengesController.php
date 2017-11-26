<?php

namespace ctf\Http\Controllers\Challs;

use Auth;
use ctf\User;
use ctf\Models\Category;
use ctf\Models\Challenge;
use ctf\Models\SecurityHash;
use ctf\Http\Requests\FlagRequest;
use ctf\Models\ChallengesResolvido;
use ctf\Http\Requests\ChallsRequest;
use ctf\Http\Controllers\Controller;


class ChallengesController extends Controller
{

    private $challenge;

    /**
     * ChallengesController constructor.
     * @param Challenge $challenge
     */
    public function __construct(Challenge $challenge)
    {
        $this->challenge = $challenge;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userView()
    {
        $challenges = Challenge::all()->where('disponivel', true);
        $pontos = User::with('challenges')->get()->where(
            'id', '=', Auth::user()->id)->first()['relations']['challenges']->sum('pontos');
        return view('challenges.index_user', compact('challenges', 'pontos'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        $challenges = Challenge::all();
        return view('challenges.index', compact('challenges'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateView(Category $category)
    {
        $categorias = Category::all();
        if ($categorias->count() == 0) {
            \Session::flash('zeroCategorias', "Não há nenhuma categoria cadastrada");
        }
        return view('challenges.create', compact('categorias'));
    }

    /**
     * @param ChallsRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createFlag(ChallsRequest $request)
    {
        $this->challenge->fill($request->all());
        $this->challenge->disponivel = true;
        $this->challenge->flag = $this->encodeFlag($request->flag);
        $this->challenge->categories_id = $request->categories_id;
        if (!$this->challenge->save()) {
            return view('erros.404');
        }
        $challenge = $this->challenge->nome;
        \Session::flash('nova', "A categoria $challenge foi criada com sucesso");
        return redirect()->route('adminChall', compact('challenge'));
    }

    /**
     * @param ChallengesResolvido $challengesResolvido
     * @param FlagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitFlag(ChallengesResolvido $challengesResolvido, FlagRequest $request)
    {

        $assert = $this->challenge->where("flag", $this->encodeFlag($request->flag));
        $flag = 'null';
        if ($assert->count() == 1) {
            $flag = $assert->first()->nome;
            $values = ['users_id' => Auth::user()->id, 'challenges_id' => $assert->first()->id];
            $challengesResolvido->fill($values);
            $resolvido = ChallengesResolvido::all()->where(
                'challenges_id', $values['challenges_id']
            )->where('users_id', $values['users_id']);
            if ($resolvido->count() == 0) {
                $challengesResolvido->saveOrFail();
                \Session::flash('flagCaptured', "$flag");
            } else {
                \Session::flash('jaCapturado', "$flag");
            }
        } else {
            \Session::flash('naoCerto', "$flag");
        }
        return redirect()->route("challs");
    }

    /**
     * @param $nome
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete($nome, $id)
    {
        $challenge = $this->challenge->findOrFail($id)->where('nome', $nome)->first();
        if (!$challenge->delete()) {
            return view('erros.404');
        }
        \Session::flash('deletado', $challenge->nome);
        return redirect()->route('adminChall');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewUpdate($id)
    {
        $categorias = Category::all();
        if (is_numeric($id)) {
            $challenge = Challenge::all()->where('id', $id)->first();
            $challenge->flag = $this->decodeFlag($challenge->flag);
            return view('challenges.edit', compact('challenge', 'categorias'));
        }
        abort(404);
    }

    /**
     * @param ChallsRequest $request
     * @param $id
     * @param $nome
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChallsRequest $request, $id, $nome)
    {
        $updated = Challenge::all()->where('id', $id)->first();
        $updated->update($request->all());
        $updated->update(['flag'=>$this->encodeFlag($request->flag)]);
        $novo = $request->input('nome');
        \Session::flash('atualizado', "A categoria $nome foi atualizada para $novo");
        return \Redirect::route('adminChall');
    }

    public function encodeFlag($pure){
        $flag = base64_encode(
            base64_encode(
                base64_encode($pure)
            )
        );
        return $flag;
    }

    public function decodeFlag($encode){
        $flag = base64_decode(
            base64_decode(
                base64_decode($encode)
            )
        );
        return $flag;
    }
}
