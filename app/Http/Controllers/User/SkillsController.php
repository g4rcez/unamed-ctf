<?php

namespace ctf\Http\Controllers\User;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\SkillsRequest;
use ctf\Models\Skill;
use Request;

class SkillsController extends Controller
{
    private $skills;

    public function __construct(Skill $skills)
    {
        $this->skills = $skills;
    }

    public function view()
    {
        $skills = Skill::all();
        return view('maestrias.index', compact('skills'));
    }

    public function create(SkillsRequest $request)
    {
        $this->skills->fill($request->all());
        if (!$this->skills->save()) {
            abort(503, 'Erro ao salvar a categoria.');
        }
        $name= $this->skills->name;
        \Session::flash('nova', "$name");
        return redirect()->route('skills');
    }

    public function update(SkillsRequest $request, $name, $id)
    {
        $updated = Skill::all()->find($id);
        $updated->fill($request->all())->update();
        $new = $request->input('name');
        \Session::flash('atualizado', "$name||$new");
        return redirect()->route('skills');
    }

    public function delete($nome, $id)
    {
        $maestria = $this->skills->findOrFail($id)->where('name', $nome)->first();
        if (!$maestria->delete()) {
            abort(500);
        }
        \Session::flash('deletado', "$nome");
        return redirect()->route('skills');
    }
}
