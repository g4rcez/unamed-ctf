<?php

namespace ctf\Http\Controllers\User;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\TeamRequest;
use ctf\Http\Transactions\TeamUsers;
use ctf\Models\Team;
use ctf\Models\UserTeam;
use ctf\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    private $team;
    private $user;

    public function __construct(Team $team, User $user)
    {
        $this->team = $team;
        $this->user = $user;
    }

    public function viewCreate()
    {
        $user = Auth::user();
        $loggedUser = $this->user->where('id', $user->id)->first();
        if ($loggedUser->team_id !== null) {
            return redirect()->route('myTeam');
        }
        return view('team.create');
    }

    public function myTeam()
    {
        $userSession = Auth::user();
        $team = $this->team->where('id', $userSession->team_id)->first();
        $allUsers = $this->user->where('team_id', '=', $team->id)->get();
        $users = [];
        $challenges = [];
        $categories = [];
        foreach ($allUsers as $user) {
            array_push($users, $this->builtUserTeam($user));
            foreach ($user->challenges()->get() as $challenge) {
                array_push($challenges, $this->builtChallenge($challenge));
                array_push($categories, $challenge->category()->first()->nome);
            }
        }
        usort($users, function ($a, $b) {
            return $a->getPontos() < $b->getPontos();
        });
        $challenges = array_unique($challenges, SORT_REGULAR);
        $categories = array_unique($categories, SORT_REGULAR);
        return view('team.index', compact('users', 'team', 'challenges', 'categories'));
    }

    /**
     * @param $user
     * @return mixed
     */
    public function builtUserTeam($user)
    {
        $userTeam = new UserTeam();
        return $userTeam
            ->setChallenges($user->challenges()->get()->toArray())
            ->setNickname($user['nickname'])
            ->setId($user['id'])
            ->setPontos($user->challenges()->sum('pontos'));
    }

    /**
     * @param $challenge
     * @return array
     */
    public function builtChallenge($challenge)
    {
        return [
            'id' => $challenge->id,
            'nome' => $challenge->nome,
            'pontos' => $challenge->pontos,
            'pontos' => $challenge->pontos,
            'autor' => $challenge->autor,
            'categoria' => $challenge->category()->first()->nome,
        ];
    }

    /**
     * @param TeamRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function createTeam(TeamRequest $request)
    {
        $this->team->fill($request->all());
        $token = md5($request->nome . $request->avatar);
        $this->team->token = $token;
        if ($this->team->save()) {
            $user = Auth::user();
            TeamUsers::setToCaptain($user->id, $token);
            return redirect()->route('home');
        }
        abort(500);
    }

    public
    function associateTeam(Request $request)
    {
        $team = $this->team->where('token', '=', $request->input('token'))->first();
        $user = Auth::user();
        if ($user->team_id === null) {
            TeamUsers::setTeam($user->id, $team);
            return redirect()->home();
        }
        abort(500);
    }
}
