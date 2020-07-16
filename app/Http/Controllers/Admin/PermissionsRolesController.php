<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PermissionRoles;
use App\Permission;
use App\Role;
use App\Specie;
use App\Language;
use Gate;

class PermissionsRolesController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $permissions = Permission::all();
        $roles = Role::all();

        return view('admin.permission_roles.permissions_roles-view')->with([
            'languages' => $languages,
            'species' => $species,
            'roles' => $roles,
            'permissions' => $permissions,
            'role_permissions' => $permissions[0]
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function public(Request $request) {

        $permission_roles = PermissionRoles::where(['role_id' => $request->role, 'permission_id' => $request->permission])->first();

        if($permission_roles){
            if($permission_roles->delete()) {
                return 'delete';
            }
        } else {

            $data['role_id'] = $request->role;
            $data['permission_id'] = $request->permission;

            $permission_roles = new PermissionRoles;
            $permission_roles->fill($data);

            if($permission_roles->save()) {
                return 'save';
            }
        }
    }
}
