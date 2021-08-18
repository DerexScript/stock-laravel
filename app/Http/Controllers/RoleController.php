<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {


        $credentials = $role->only('id', 'name');
        $rules = [
            'id' => 'exists:jobs,id',
        ];
        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput($credentials)->withErrors($validator);
        } else {
            echo "OK";
        }

        exit();


        return response($credentials)->header('Content-Type', 'application/json');
        exit();

        return response($role->toJson())->header('Content-Type', 'application/json');
        exit();

        $role->delete();
        return redirect()->back();
    }
}
