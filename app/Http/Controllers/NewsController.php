<?php

namespace ctf\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use ctf\User;
use ctf\Models\Noticia;
use ctf\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    private $noticia;

    public function __construct(Noticia $news)
    {
        $this->noticia = $news;
    }

    public function viewNews()
    {
        $view = "news.index_guest";
        if (!Auth::guest())
            $view = "news.index";
        $users = User::all();
        $noticias = Noticia::all();
        return view($view, compact('noticias', 'users'));
    }

    public function viewCreate()
    {
        return view('news.create');
    }

    public function create(NewsRequest $request)
    {
        $this->noticia->fill($request->all());
        $this->noticia->users_id = Auth::user()->id;
        if (!$this->noticia->save()) {
            return view('errors.404');
        }
        return \Redirect::route('categorias', compact('novaCategoria'));
    }
}
