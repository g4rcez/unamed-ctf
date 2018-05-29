<?php

namespace ctf\Http\Controllers\Admin;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\PermissionRequest;
use ctf\Models\Permission;


class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function view()
    {
        $permissions = Permission::all();
        return view('auth.permissions.index', compact('permissions'));
    }

    public function create(PermissionRequest $request)
    {
        $this->permission->fill($request->all());
        if (!$this->permission->save()) {
            abort(503, 'Erro ao salvar a categoria.');
        }
        $permission = $this->permission->permissao;
        \Session::flash('nova', "$permission");
        return \Redirect::route('permissions', compact('permission'));
    }

    public function update(PermissionRequest $request, $nome, $id)
    {
        $updated = Permission::all()->find($id);
        $updated->update($request->all());
        $novo = $request->input('permissao');
        $novo = str_replace(' ', '', $novo);
        \Session::flash('atualizado', "$nome||$novo");
        return redirect()->route('permissions');
    }

    /**
     * @param $nome
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete($nome, $id)
    {
        $permission = $this->permission->findOrFail($id)->where('permission', $nome)->first();
        try {
            $permission->delete();
        } catch (\Exception $e) {
            abort(500);
        }
        \Session::flash('deletado', "$nome");
        return redirect()->route('permissions');
    }
}
