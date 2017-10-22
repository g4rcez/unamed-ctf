<?php

namespace ctf\Http\Controllers\Challs;

use Request;
use ctf\Models\Challenge;
use ctf\Http\Controllers\Controller;


class ChallengesController extends Controller
{

    private $challenge;

    public function __construct(Challenge $challenge)
    {
        $this->challenge = $challenge;
    }

    public function userView()
    {
        return view('challenges.index_user');
    }
}
