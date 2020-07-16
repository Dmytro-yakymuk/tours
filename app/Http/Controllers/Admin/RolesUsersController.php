<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\RolesUsers;
use App\Role;
use App\Specie;
use App\Language;
use Gate;

class RolesUsersController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $roles = Role::all();
        $users = User::all();

        return view('admin.roles_users.roles_users-view')->with([
            'languages' => $languages,
            'species' => $species,
            'roles' => $roles,
            'users' => $users,
            'role_permissions' => $users[0]
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

        $roles_user = RolesUsers::where(['role_id' => $request->role, 'user_id' => $request->user])->first();

        if($roles_user){
            if($roles_user->delete()) {
                return 'delete';
            }
        } else {

            $data['role_id'] = $request->role;
            $data['user_id'] = $request->user;

            $roles_user = new RolesUsers;
            $roles_user->fill($data);

            if($roles_user->save()) {
                return 'save';
            }
        }
    }
}
