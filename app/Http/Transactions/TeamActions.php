<?php

namespace ctf\Http\Transactions;

use ctf\Models\UserTeamDTO;

class TeamActions
{
    /**
     * @param $challenge
     * @return array
     */
    public static function builtChallenge($challenge)
    {
        return [
            'id' => $challenge->id,
            'name' => $challenge->nome,
            'points' => $challenge->pontos,
            'author' => $challenge->author,
            'category' => $challenge->category()->first()->nome,
        ];
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function builtUserTeam($user)
    {
        $userTeam = new UserTeamDTO();
        return $userTeam
            ->setChallenges($user->challenges()->get()->toArray())
            ->setNickname($user['nickname'])
            ->setId($user['id'])
            ->setPoints($user->challenges()->sum('points'));
    }

    public static function fillUsers($allUsers)
    {
        foreach ($allUsers as $user) {
            array_push($users, TeamActions::builtUserTeam($user));
            foreach ($user->challenges()->get() as $challenge) {
                array_push($challenges, TeamActions::builtChallenge($challenge));
                array_push($categories, $challenge->category()->first()->nome);
            }
        }
        return array($users, $challenges, $categories);
    }
}