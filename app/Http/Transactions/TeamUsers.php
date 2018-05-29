<?php

namespace ctf\Http\Transactions;

use ctf\Models\Team;
use ctf\User;

class TeamUsers
{
    public static function setToCaptain($id, $token)
    {
        $user = User::all()->where('id', $id)->first();
        $team = Team::all()->where('token', $token)->first();
        return $user->update(['capitao' => true, 'team_id' => $team->id]);
    }

    public static function setTeam($id, $team)
    {
        $user = User::all()->where('id', $id)->first();
        return $user->update(['capitao' => false, 'team_id' => $team->id]);
    }
}