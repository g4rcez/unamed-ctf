<?php

namespace ctf\Http\Controllers\Admin;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\PermissionRequest;
use ctf\Models\Permission;


class PermissionController extends Controller
{
    private $permissao;

    public function __construct(Permission $permissao)
    {
        $this->permissao = $permissao;
    }

    public function view()
    {
        $permissoes = Permission::all();
        return view('auth.permissions.index', compact('permissoes'));
    }

    public function create(PermissionRequest $request)
    {
        $this->permissao->fill($request->all());
        if (!$this->permissao->save()) {
            abort(503, 'Erro ao salvar a categoria.');
        }
        $permissao = $this->permissao->permissao;
        \Session::flash('nova', "A categoria $permissao foi criada com sucesso");
        return \Redirect::route('permissions', compact('permissao'));
    }

    public function update(PermissionRequest $request, $nome, $id)
    {
        $updated = Permission::all()->find($id);
        $updated->update($request->all());
        $novo = $request->input('permissao');
        $novo = str_replace(' ', '', $novo);
        \Session::flash('atualizado', "A maestria $nome foi atualizada para $novo");
        return redirect()->route('permissions');
    }

    public function delete($nome, $id)
    {
        $permissao = $this->permissao->findOrFail($id)->where('permissao', $nome)->first();
        if (!$permissao->delete()) {
            abort(500);
        }
        \Session::flash('deletado', "A permissão $nome foi deletada com sucesso");
        return redirect()->route('permissions');
    }
}
