<?php namespace ctf\Http\Controllers\Challs;

use Request;
use ctf\Models\Challenge;
use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\ChallsRequest;


class Challenges extends Controller
{

    private $challenge;

    public function __construct(Challenge $challenge)
    {
        $this->challenge = $challenge;
    }

    public function viewCreate(){
        return view('challenges.index');
    }

    public function create(ChallsRequest $request){
        $this->challenge->fill($request->all());
        if (!$this->challenge->save()) {
            abort(503);
        }
        return "sucesso";
    }
}
