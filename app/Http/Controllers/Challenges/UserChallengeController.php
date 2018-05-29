<?php

namespace ctf\Http\Controllers\Challenges;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\FlagRequest;
use ctf\Http\Transactions\LogErrors;
use ctf\Models\Category;
use ctf\Models\Challenge;
use ctf\Models\ChallengesResolvido;
use ctf\User;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserChallengeController extends Controller
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
        $categories = Category::all();
        $pontos = User::with('challenges')->get()->where(
            'id', '=', Auth::user()->id)->first()['relations']['challenges'];
        return view('challenges.index_user',
            compact('challenges', 'pontos', 'categories'));
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
     * @param ChallengesResolvido $challengesResolvido
     * @param FlagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitFlagWithName(ChallengesResolvido $challengesResolvido, FlagRequest $request)
    {
        $assert = $this->challenge->where(
            "flag", $request->flag)->where(
            "nome", $request->nome);
        if ($assert->count() === 1) {
            list($flag, $resolvido) = $this->searchFlag($challengesResolvido, $assert);
            if ($resolvido->count() == 0) {
                try {
                    $challengesResolvido->saveOrFail();
                    LogErrors::wrongFlag(Auth::user(), $assert->get(), "right");
                    \Session::flash('flagCaptured', $request->nome);
                } catch (Throwable $e) {
                }
            } else {
                LogErrors::wrongFlag(Auth::user(), $assert, "again");
                \Session::flash('jaCapturado', $request->nome);
            }
        } else {
            $flag = $this->challenge->where("nome", $request->nome)->first();
            LogErrors::wrongFlag(Auth::user(), $flag, "wrong");
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
                LogErrors::wrongFlag(Auth::user(), $assert, "right");
                \Session::flash('flagCaptured', "$flag");
            } else {
                LogErrors::wrongFlag(Auth::user(), $assert, "again");
                \Session::flash('jaCapturado', "$flag");
            }
        } else {
            LogErrors::wrongFlag(Auth::user(), $assert, "wrong");
            \Session::flash('naoCerto', "$flag");
        }
        return redirect()->route("challs");
    }
}
