<?php

namespace ctf\Http\Controllers\Challs;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\CategoryRequest;
use ctf\Models\Category;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function view()
    {
        $categorias = Category::all();
        return view('categories.index', compact('categorias'));
    }

    public function viewCreate()
    {
        return view('categories.create');
    }

    public function create(CategoryRequest $request)
    {
        $this->category->fill($request->all());
        if (!$this->category->save()) {
            return view('errors.404');
        }
        $novaCategoria = $this->category->nome;
        \Session::flash('nova', "A categoria $novaCategoria foi criada com sucesso");
        return \Redirect::route('categorias', compact('novaCategoria'));
    }

    public function viewUpdate($nome, $id)
    {
        $categoria = Category::all()->where('nome', $nome)->where('id', $id)->first();
        return view('categories.edit', compact('categoria'));
    }

    public function update(CategoryRequest $request, $nome, $id)
    {
        $updated = Category::all()->find($id);
        $updated->update($request->all());
        $novo = $request->input('nome');
        \Session::flash('atualizado', "A categoria $nome foi atualizada para $novo");
        return \Redirect::route('categorias');
    }

    public function delete($nome, $id)
    {
        $categoria = $this->category->findOrFail($id)->where('nome', $nome)->first();
        if(!$categoria->delete()){
            return view('errors.404');
        }
        \Session::flash('deletado', "A categoria $nome foi deletada com sucesso");
        return redirect()->route('categorias');
    }
}
