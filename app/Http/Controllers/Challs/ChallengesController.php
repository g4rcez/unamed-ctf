<?php

namespace ctf\Http\Controllers\Challs;

use Auth;
use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\ChallsRequest;
use ctf\Http\Requests\FlagRequest;
use ctf\Models\Category;
use ctf\Models\Challenge;
use ctf\Models\ChallengesResolvido;
use ctf\Models\Maestria;
use ctf\Models\MaestriaRequired;
use ctf\User;


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
        $maestrias = Challenge::with('skills')->get();
        $challenges = Challenge::all()->where('disponivel', true);
        $categories = Category::all();
        $pontos = User::with('challenges')->get()->where(
            'id', '=', Auth::user()->id)->first()['relations']['challenges'];
        return view('challenges.index_user',
            compact('challenges', 'pontos', 'maestrias', 'categories'));
    }

    public function userSearch($categoryId)
    {
        $categories = Category::all();
        $maestrias = Challenge::with('skills')->get();
        $challenges = Challenge::all()->where('disponivel', true)->where("categories_id", $categoryId);
        $pontos = User::with('challenges')->get()->where(
            'id', '=', Auth::user()->id)->first()['relations']['challenges'];
        return view('challenges.index_user',
            compact('challenges', 'categories', 'pontos', 'maestrias'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView(MaestriaRequired $maestriaRequired)
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
        $arrayTeste = [];
        if (!empty($request->maestrias)) {
            try {
                foreach ($request->maestrias as $maestria) {
                    array_push($arrayTeste, [
                        'maestrias_id' => $maestria,
                        'challenges_id' => $this->challenge->id,
                        'challenges_categories_id' => $this->challenge->categories_id
                    ]);
                }
                $this->challenge->skills()->attach($arrayTeste);
                $this->challenge->skills()->save(new MaestriaRequired());
            } catch (\Exception $exception) {
            }
        }
        return redirect()->route('adminChall', compact('challenge'));
    }

    public function encodeFlag($pure)
    {
        $flag = base64_encode(
            base64_encode(
                base64_encode($pure)
            )
        );
        return $flag;
    }

    /**
     * @param ChallengesResolvido $challengesResolvido
     * @param FlagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function submitFlagWithName(ChallengesResolvido $challengesResolvido, FlagRequest $request)
    {
        $assert = $this->challenge->where(
            "flag", $this->encodeFlag($request->flag))->where(
            "nome", $request->nome
        );
        if ($assert->count() == 1) {
            list($flag, $resolvido) = $this->searchFlag($challengesResolvido, $assert);
            if ($resolvido->count() == 0) {
                $challengesResolvido->saveOrFail();
                \Session::flash('flagCaptured', $request->nome);
            } else {
                \Session::flash('jaCapturado', $request->nome);
            }
        } else {
            \Session::flash('naoCerto', $request->nome);
        }
        return redirect()->route("challs");
    }

    /**
     * @param ChallengesResolvido $challengesResolvido
     * @param $assert
     * @return array
     */
    private function searchFlag(ChallengesResolvido $challengesResolvido, $assert)
    {
        $flag = $assert->first()->nome;
        $values = ['users_id' => Auth::user()->id, 'challenges_id' => $assert->first()->id];
        $challengesResolvido->fill($values);
        $resolvido = ChallengesResolvido::all()->where(
            'challenges_id', $values['challenges_id']
        )->where('users_id', $values['users_id']);
        return array($flag, $resolvido);
    }

    public function submitFlag(ChallengesResolvido $challengesResolvido, FlagRequest $request)
    {
        $assert = $this->challenge->where("flag", $this->encodeFlag($request->flag));
        $flag = 'null';
        if ($assert->count() == 1) {
            list($flag, $resolvido) = $this->searchFlag($challengesResolvido, $assert);
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
            $challenge->flag = $this->decodeFlag($challenge->flag);
            return view('challenges.edit', compact('challenge', 'categorias', 'maestrias'));
        }
        abort(404);
    }

    public function decodeFlag($encode)
    {
        $flag = base64_decode(
            base64_decode(
                base64_decode($encode)
            )
        );
        return $flag;
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
}
