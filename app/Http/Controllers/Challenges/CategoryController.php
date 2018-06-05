<?php

namespace ctf\Http\Controllers\Challenges;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\CategoryRequest;
use ctf\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $categories = Category::all()->sortBy("name");
        return view('categories.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewCreate()
    {
        return view('categories.create');
    }

    /**
     * @param $nome
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewUpdate($name, $id)
    {
        $category = Category::all()->where('name', $name)
            ->where('id', $id)->first();
        return view('categories.edit', compact('category'));
    }

    public function create(CategoryRequest $request)
    {
        $this->category->fill($request->all());
        $this->category->modified_by = Auth::user()->nickname;
        if (!$this->category->save()) {
            abort(500, "Could not be save that shit");
        }
        $newCategory = $this->category->name;
        \Session::flash('new', "$newCategory");
        return redirect()->route('categories');
    }

    public function update(CategoryRequest $request, $name, $id)
    {
        $updated = Category::all()->find($id);
        $updated->update($request->all());
        $updated->update(["modificado_por" => Auth::user()->nickname]);
        $new = $request->input('name');
        \Session::flash('updated', "$name||$new");
        return redirect()->route('categories');
    }

    public function delete($nome, $id)
    {
        $category = $this->category->findOrFail($id)->where('nome', $nome)->first();
        try {
            $category->delete();
        } catch (\Exception $e) {
            return view('errors.404');
        }
        \Session::flash('deleted', "A category $nome foi deletada com sucesso");
        return redirect()->route('categorias');
    }
}
