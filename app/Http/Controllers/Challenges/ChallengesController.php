<?php

namespace ctf\Http\Controllers\Challenges;

use Auth;
use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\ChallsRequest;
use ctf\Models\Category;
use ctf\Models\Challenge;
use ctf\Models\Maestria;
use ctf\Models\MaestriaRequired;


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
    public function adminView()
    {
        $challenges = Challenge::all();
        $maestrias = Challenge::with('skills')->get();
        return view('challenges.index', compact('challenges', 'maestrias'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCreateView()
    {
        $categorias = Category::all();
        $maestrias = Maestria::all();
        if ($categorias->count() == 0) {
            \Session::flash('zeroCategorias', "Não há nenhuma categoria cadastrada");
        }
        if ($maestrias->count() == 0) {
            \Session::flash('zeroMaestrias', "Não há nenhuma maestria");
        }
        return view('challenges.create', compact('categorias', 'maestrias'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewUpdate($id)
    {
        $maestrias = Maestria::all();
        $categorias = Category::all();
        if (is_numeric($id)) {
            $challenge = Challenge::all()->where('id', $id)->first();
            return view('challenges.edit', compact('challenge', 'categorias', 'maestrias'));
        }
        abort(404);
    }

    /**
     * @param ChallsRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createFlag(ChallsRequest $request)
    {
        $this->challenge->fill($request->all());
        $this->challenge->categories_id = $request->categories_id;
        $this->challenge->disponivel = (bool)$request->disponivel;
        if (!$this->challenge->save())
            return view('erros.404');
        $challenge = $this->challenge->nome;
        \Session::flash('nova', "A categoria $challenge foi criada com sucesso");
        if (!empty($request->maestrias))
            foreach ($request->maestrias as $skill) {
                $required = new MaestriaRequired();
                $required->fill([
                    'maestrias_id' => $skill,
                    'challenges_id' => $this->challenge->id,
                ]);
                $required->save();
            }
        return redirect()->route('adminChall');
    }

    /**
     * @param ChallsRequest $request
     * @param $id
     * @param $nome
     * @param MaestriaRequired $maestriaRequired
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChallsRequest $request, $id, $nome, MaestriaRequired $maestriaRequired)
    {
        $updated = Challenge::all()->where('id', $id)->first();
        $updated->update($request->all());
        $updated->update(['flag' => $this->encodeFlag($request->flag)]);
        if (!empty($request->maestrias)) {
            foreach ($request->maestrias as $maestria) {
                $maestriaRequired->fill([
                    'maestrias_id' => $maestria,
                    'challenges_id' => $id,
                    'challenges_categories_id' => $updated->categories_id
                ]);
            }
            $maestriaRequired->update();
        }
        $novo = $request->input('nome');
        \Session::flash('atualizado', "A categoria $nome foi atualizada para $novo");
        return \Redirect::route('adminChall');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function delete($id)
    {
        $challenge = $this->challenge->findOrFail($id)->first();
        if (!$challenge->delete()) {
            return view('erros.404');
        }
        \Session::flash('deletado', $challenge->nome);
        return redirect()->route('adminChall');
    }
}
