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
        $updated = Maestria::all()->find($id);
        $updated->update($request->all());
        $novo = $request->input('maestria');
        $novo = str_replace(' ', '', $novo);
        \Session::flash('atualizado', "A maestria $nome foi atualizada para $novo");
        return redirect()->route('maestrias');
    }

    public function delete($nome, $id)
    {
        $maestria = $this->maestria->findOrFail($id)->where('maestria', $nome)->first();
        if(!$maestria->delete()){
            abort(500);
        }
        \Session::flash('deletado', "A maestria $nome foi deletada com sucesso");
        return redirect()->route('maestrias');
    }
}
