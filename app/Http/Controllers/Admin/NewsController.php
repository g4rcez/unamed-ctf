<?php

namespace ctf\Http\Controllers\Admin;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\NewsRequest;
use ctf\Models\Noticia;
use ctf\User;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    private $news;

    public function __construct(Noticia $news)
    {
        $this->news = $news;
    }

    public function viewNews()
    {
        $view = "news.index_guest";
        if (!Auth::guest())
            $view = "news.index";
        $users = User::all();
        $news = Noticia::all();
        return view($view, compact('news', 'users'));
    }

    public function viewCreate()
    {
        return view('news.create');
    }

    public function create(NewsRequest $request)
    {
        $this->news->fill($request->all());
        $this->news->users_id = Auth::user()->id;
        if (!$this->news->save()) {
            return view('errors.404');
        }
        return redirect()->route('categorias');
    }

    public function patrocinadores()
    {
        return view("patrocinadores.index");
    }
}
