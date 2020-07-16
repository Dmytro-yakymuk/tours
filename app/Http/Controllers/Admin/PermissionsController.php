<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Permission;
use App\Specie;
use App\Language;
use Gate;

class PermissionsController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $permissions = Permission::all();

        return view('admin.permissions.permissions-view')->with([
            'languages' => $languages,
            'species' => $species,
            'permissions' => $permissions,
            'role_permissions' => $permissions[0]
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if(Gate::denies('create', new Permission)) {
            abort(403, 'Немає прав на додавання видів турів!!!');
        }

        $data['name'] = $request->name;
        $data['title'] = $request->title;

        $role = new Permission;
        $role->fill($data);

        if($role->save()) {

            $permissions = Permission::all();
            $languages = Language::all();
            return view('admin.permissions.permissions_table')->with([
                'permissions' => $permissions,
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

        $role = Permission::where(['id' => $id])->first();
        $role->fill($data);

        if($role->update()) {

            $permissions = Permission::all();
            $languages = Language::all();
            return view('admin.permissions.permissions_table')->with([
                'permissions' => $permissions,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $role = Permission::where(['id' => $id])->first();

        if($role->delete()) {

            $permissions = Permission::all();
            $languages = Language::all();
            return view('admin.permissions.permissions_table')->with([
                'permissions' => $permissions,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }
}
