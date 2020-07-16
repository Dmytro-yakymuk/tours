<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Specie;
use App\Language;
use Gate;
use App\RolesUsers;

class UsersController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $users = User::all();

        return view('admin.users.users-view')->with([
            'languages' => $languages,
            'species' => $species,
            'users' => $users,
            'role_permissions' => $users[0]
        ]);
    }

    public function create() { }

    public function store(Request $request) { }

    public function show($id) { }

    public function edit($id) { }

    public function update(Request $request, $id)
    {
        $data['name'] = $request->name;
        $data['title'] = $request->title;

        $user = User::where(['id' => $id])->first();
        $user->fill($data);

        if($user->update()) {

            $users = User::all();
            $languages = Language::all();
            return view('admin.users.users_table')->with([
                'users' => $users,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $user = User::where(['id' => $id])->first();

        $roles_user = RolesUsers::where('user_id', $id)->get();
        if($roles_user->isNotEmpty()){
            if(count($roles_user) > 0){
                foreach ($roles_user as $roles_us) {
                    $roles_us->delete();  
                }
            } else {
                $roles_user->delete();
            }
        }

        if($user->delete()) {

            $users = User::all();
            $languages = Language::all();
            return view('admin.users.users_table')->with([
                'users' => $users,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }
}
