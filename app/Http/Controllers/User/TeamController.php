<?php

namespace ctf\Http\Controllers\User;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\TeamRequest;
use ctf\Http\Transactions\TeamActions;
use ctf\Http\Transactions\TeamUsers;
use ctf\Models\Team;
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
        $team = $this->team->where('id', Auth::user()->team_id)->first();
        list($users, $challenges, $categories) =
            TeamActions::fillUsers($this->user->where('team_id', '=', $team->id)->get());
        usort($users, function ($a, $b) {
            return $a->getPontos() < $b->getPontos();
        });
        $challenges = array_unique($challenges, SORT_REGULAR);
        $categories = array_unique($categories, SORT_REGULAR);
        return view('team.index', compact('users', 'team', 'challenges', 'categories'));
    }

    /**
     * @param $allUsers
     * @return array
     */


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
