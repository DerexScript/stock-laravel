<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.home', ["title" => "Categorias De Produtos", "categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //Category::create($request->all());
        $request->validate(['name' => 'unique:categories'], ['name.unique' => 'Uma categoria com esse nome já existe.']);
        $external = $request->has('external') ?? false;
        $category = new Category();
        $category->forceFill(['name' => $request->name, 'external' => $external]);
        $category->save();
        return redirect()->route('createCategory');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', ['title' => 'Editar categoria', 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'unique:categories'], ['name.unique' => 'Uma categoria com esse nome já existe.']);
        $reqName = $request->only('name', 'external');
        $reqName["external"] = $request->has('external') ?? false;
        if ($category->update($reqName)) {
            return redirect()->route('createCategory');
        }
        return redirect()->back()->withErrors(["update" => "Erro ao tentar atualizar categoria"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        if ($category->products->count() == 0) {
            $category->delete();
            DB::statement("ALTER TABLE categories AUTO_INCREMENT=1;");
            return redirect()->back();
        }
        return redirect()->back()->withErrors(["relationship" => "Esta categoria está em uso pelos seguintes produtos: {$category->products->implode('id', ', ')}."]);
    }
}
