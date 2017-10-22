<?php

namespace ctf\Http\Controllers\User;

use ctf\Http\Controllers\Controller;
use ctf\Models\Maestria;
use Request;

class MaestriaController extends Controller
{
    private $maestria;

    public function __construct(Maestria $maestria)
    {
        $this->maestria = $maestria;
    }

    public function view()
    {
        $maestrias = Maestria::all();
        return view('maestrias.index', compact('maestrias'));
    }

    public function viewCreate()
    {
        return view('categories.create');
    }

    public function create(CategoryRequest $request)
    {
        $this->category->fill($request->all());
        if (!$this->category->save()) {
            abort(503, 'Erro ao salvar a categoria.');
        }
        $novaCategoria = $this->category->nome;
        \Session::flash('nova', "A categoria $novaCategoria foi criada com sucesso");
        return \Redirect::route('categorias', compact('novaCategoria'));
    }
}
