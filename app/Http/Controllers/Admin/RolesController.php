<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use App\Http\Requests\SpecieRequest;
use App\Role;
use App\Specie;
use App\Language;
use Gate;

class RolesController extends Controller {

    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $roles = Role::all();

        return view('admin.roles.roles-view')->with([
            'languages' => $languages,
            'species' => $species,
            'roles' => $roles,
            'role_permissions' => $roles[0]
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if(Gate::denies('create', new Role)) {
            abort(403, 'Немає прав на додавання видів турів!!!');
        }

        $data['name'] = $request->name;
        $data['title'] = $request->title;

        $role = new Role;
        $role->fill($data);

        if($role->save()) {

            $roles = Role::all();
            $languages = Language::all();
            return view('admin.roles.roles_table')->with([
                'roles' => $roles,
                'languages' => $languages,
                'success_message' => 'Добавлено!!'
            ])->render();

        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data['name'] = $request->name;
        $data['title'] = $request->title;

        $role = Role::where(['id' => $id])->first();
        $role->fill($data);

        if($role->update()) {

            $roles = Role::all();
            $languages = Language::all();
            return view('admin.roles.roles_table')->with([
                'roles' => $roles,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $role = Role::where(['id' => $id])->first();

        if($role->delete()) {

            $roles = Role::all();
            $languages = Language::all();
            return view('admin.roles.roles_table')->with([
                'roles' => $roles,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }
}
