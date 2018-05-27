<?php

namespace ctf\Http\Controllers\User;

use ctf\Http\Controllers\Controller;
use ctf\Http\Transactions\RankingOrder;
use ctf\Models\Challenge;
use ctf\Models\ChallengesResolvido;
use ctf\Models\Team;
use ctf\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $user;
    private $team;

    public function __construct(User $user, Team $team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    public function index()
    {
        $usuario = Auth::user();
        if (!Auth::guest()) {
            $challenges = User::with('challenges')->get()->where(
                'id', $usuario->id)->first()['relations']['challenges'];
            $categories = [
                'nome' => [], 'id' => [], 'pontos' => []
            ];
            foreach ($challenges as $chall) {
                if (!in_array($chall->category, $categories)) {
                    array_push($categories['id'], $chall->category->id);
                    array_push($categories['nome'], $chall->category);
                }
                $categories['pontos'][$chall->category->nome] = $challenges->where(
                    'categories_id', $chall->category->id)->sum('pontos');
            }
            $pontuacao = $challenges->sum('pontos');
            try {
                $team = $this->team->where('id', '=', $usuario->team_id)->first();
                return view('user.index', compact(
                    'usuario', 'pontuacao', 'challenges', 'categories', 'team'
                ));
            } catch (\Exception $e) {
            }
            return view('user.index', compact(
                'usuario', 'pontuacao', 'challenges', 'categories'
            ));
        }
        return view('guest.index');
    }

    public function news()
    {
        if (!Auth::guest()) {
            return view('news.user');
        }
        return view('news.guest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function scoreboard()
    {
        $score = RankingOrder::getUserList($this->team);
        return view('user.scoreboard', compact('score'));
    }

    public function timeline()
    {
        $challenges = [];
        foreach (ChallengesResolvido::all()->sortBy('created_by') as $challenge) {
            $chall = Challenge::all()->where('id', $challenge->challenges_id)->first();
            $firstBlood = ChallengesResolvido::all()->where('challenges_id', $chall->id);
            $user = $this->user->where('id', $challenge->users_id)->get()->first();
            $team = Team::all()->where('id', $user->team_id)->first();
            $challenge = [
                'id' => $challenge->id,
                'firstBlood' => $firstBlood->first()->users_id === $user->id,
                'challenge' => $chall->nome,
                'points' => $chall->pontos,
                'category' => $chall->category()->first()->nome,
                'users' => $user,
                'team' => $team,
                'resolved_at' => $challenge->created_at
            ];
            array_push($challenges, $challenge);
        }
        $challenges = array_reverse($challenges);
        return view('user.timeline', compact('challenges'));
    }

}
