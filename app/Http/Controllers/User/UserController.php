<?php

namespace ctf\Http\Controllers\User;

use ctf\Models\Scoreboard;
use ctf\User;
use Illuminate\Support\Facades\Auth;
use ctf\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        if (!Auth::guest()) {
            $challenges = User::with('challenges')->get()->where(
                'id','=', $usuario->id)->first()['relations']['challenges'];
            $categories = [
                'nome'=> [], 'id' => [], 'pontos' => []
            ];
            foreach($challenges as $chall){
                if(!in_array($chall->category, $categories)){
                    array_push($categories['id'], $chall->category->id);
                    array_push($categories['nome'], $chall->category);
                }
                $categories['pontos'][$chall->category->nome] = $challenges->where(
                    'categories_id',$chall->category->id)->sum('pontos');
            }
            $pontuacao = $challenges->sum('pontos');
            return view('user.index', compact(
                'usuario', 'pontuacao', 'challenges', 'categories'
            ));
        }
        return view('guest.index');
    }

    public function news()
    {
        if(!Auth::guest()){
            return view('news.user');
        }
        return view('news.guest');
    }

    public function scoreboard(){
        $usuarios = User::all();
        $score = [];
        $count=1;
        foreach ($usuarios as $usuario){
            $challUser = User::with('challenges')->get()->where('id','=', $usuario->id);
            $scoreboard = new Scoreboard();
            $scoreboard->setNome($usuario->nickname);
            $scoreboard->setScore($challUser->first()['relations']['challenges']->sum('pontos'));
            $scoreboard->setAvatar($usuario->avatar);
            array_push($score, $scoreboard);
            $count+=1;
        }
        usort(
            $score,
            function($a, $b) {

                if( $a->getScore() == $b->getScore() ) return 0;
                return ( ( $a->getScore() < $b->getScore()) ? 1 : -1 );
            }
        );
        return view('user.scoreboard', compact('score'));
    }
}
