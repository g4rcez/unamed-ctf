<?php

namespace ctf\Http\Transactions;

use ctf\Models\Challenge;
use ctf\Models\ChallsLog;
use ctf\User;

class LogErrors
{
    public static function wrongFlag(User $user, Challenge $challenge, $action)
    {
        $log = new ChallsLog();
        $log->fill([
            'status' => $action,
            'users_id' => $user->id,
            'challenges_id' => $challenge->id
        ])->save();
    }
}