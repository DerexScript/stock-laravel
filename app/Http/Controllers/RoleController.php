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

        $request->validate(
            [
                'name' => 'unique:roles'
            ],
            [
                'name.unique' => 'Uma função com esse nome já existe.'
            ]
        );

        $role = new Role();
        $role->forceFill([
            'name' => $request->name
        ]);
        $role->save();
        return redirect()->route('createRole');
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if ($request->input('_token') != '') {
            $update = $role->update($request->all());
            if ($update) {
                return redirect()->route('createRole');
            } else {
                return redirect()->back()->withErrors(["update" => "Erro ao tentar atualizar o registro"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        //with() = eaggerload
        $r = Role::with(['category', 'user'])->find($role->id);
        if (count($r->category) === 0 && count($r->user) === 0) {
            $role->delete();
            return redirect()->back();
        }
        if (count($r->category) > 0) {
            $rc = "";
            foreach ($r->category as $c) {
                $rc .= $c->name.", ";
            }
            return redirect()->back()->withErrors(["relationship" => "Esta função está relacionada $rc"]);
        }
        if (count($r->user) > 0) {
            $ru = "";
            foreach ($r->user as $key => $u) {
                if ($key === array_key_last($r->user->toArray())) {
                    $ru .= "`".$u->name."`.";
                } else {
                    $ru .= "`".$u->name."`, ";
                }
            }
            DB::statement("ALTER TABLE `roles` AUTO_INCREMENT = 1;");
            return redirect()->back()->withErrors(["relationship" => "Esta função está em uso pelos seguintes usuarios $ru"]);
        }
    }
}
