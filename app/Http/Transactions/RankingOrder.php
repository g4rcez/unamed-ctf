<?php

namespace ctf\Http\Transactions;

use ctf\Models\ChallengesResolvido;
use ctf\Models\Scoreboard;
use ctf\Models\Team;
use ctf\User;

class RankingOrder
{
    public static function getUserList(Team $team)
    {
        $score = [];
        foreach (User::all() as $usuario) {
            $scoreboard = new Scoreboard();
            $scoreboard
                ->setNome($usuario->nickname)
                ->setScore(User::with('challenges')->get()->where('id', '=', $usuario->id)->first()['relations']['challenges']->sum('pontos'))
                ->setAvatar($usuario->avatar)
                ->setTeam($team->where('id', $usuario['team_id'])->first())
                ->setLastChall(ChallengesResolvido::all()->where("users_id", "=", $usuario->id)->last()['attributes']['created_at']);
            array_push($score, $scoreboard);
        }
        usort($score, function ($a, $b) {
            $d1 = new \DateTime($a->getLastChall());
            $d2 = new \DateTime($b->getLastChall());
            $a = $a->getScore();
            $b = $b->getScore();
            if ($d1 == null) $d1 = new \DateTime('tomorrow');
            if ($d1 > $d2) {
                if ($a > $b) return 0;
                if ($a < $b) return 1;
                if ($a == $b) return 1;
            }
            return 0;
        });
        return $score;
    }
}