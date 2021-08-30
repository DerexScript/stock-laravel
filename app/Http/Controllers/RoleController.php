<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.roles.home', ['title' => 'Funções dos usuarios', 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //Role::create($request->all());
        $request->validate(['name' => 'unique:roles'], ['name.unique' => 'Uma função com esse nome já existe.']);
        $role = new Role();
        $role->forceFill(['name' => $request->name]);
        $role->save();
        return redirect()->route('role.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('dashboard.roles.edit', ['title' => 'Editar Função', 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $reqName = $request->only('name');
        $request->validate(['name' => 'unique:roles'], ['name.unique' => 'Uma função com esse nome já existe.']);
        if ($role->update($reqName)) {
            return redirect()->route('role.create');
        }
        return redirect()->back()->withErrors(["update" => "Erro ao tentar atualizar o registro"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        if ($role->users->count() == 0) {
            $role->delete();
            DB::statement("ALTER TABLE roles AUTO_INCREMENT=1;");
            return redirect()->back();
        }
        return redirect()->back()->withErrors(["relationship" => "Esta função está em uso pelos seguintes usuarios: {$role->users->implode('username', ', ')}."]);
    }
}
