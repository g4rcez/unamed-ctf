<?php

namespace ctf\Http\Controllers\User;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\MaestriaRequest;
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

    public function create(MaestriaRequest $request)
    {
        $this->maestria->fill($request->all());
        if (!$this->maestria->save()) {
            abort(503, 'Erro ao salvar a categoria.');
        }
        $maestria = $this->maestria->nome;
        \Session::flash('nova', "A categoria $maestria foi criada com sucesso");
        return \Redirect::route('maestrias', compact('maestria'));
    }

    public function update(MaestriaRequest $request, $nome, $id)
    {
        $updated = Category::all()->find($id);
        $updated->update($request->all());
        $novo = $request->input('maestria');
        \Session::flash('atualizado', "A categoria $nome foi atualizada para $novo");
        return \Redirect::route('maestria');
    }
}
