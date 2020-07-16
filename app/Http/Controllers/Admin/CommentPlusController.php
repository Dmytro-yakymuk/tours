<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Specie;
use App\Language;
use Gate;

use App\CommentPlus;


class CommentPlusController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $comment_pluses = CommentPlus::all();

        return view('admin.comment_pluses.comment_pluses-view')->with([
            'languages' => $languages,
            'species' => $species,
            'comment_pluses' => $comment_pluses
        ]);
    }

  

    public function create()
    {
        //
    }

    public function store(Request $request) {
        // if(Gate::denies('create', new Permission)) {
        //     abort(403, 'Немає прав на додавання видів турів!!!');
        // }

        $data['name'] = $request->name;
        if($request->position){
            $data['position'] = true;
        }
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;

        
        $comment_plus = new CommentPlus;
        $comment_plus->fill($data);

        if($comment_plus->save()) {

            $comment_pluses = CommentPlus::all();
            $languages = Language::all();

            return view('admin.comment_pluses.comment_pluses_table')->with([
                'comment_pluses' => $comment_pluses,
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


    public function update(Request $request, $id) {

        $data['name'] = $request->name;
        if($request->position){
            $data['position'] = true;
        }
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;

        
        $comment_plus = CommentPlus::where(['id' => $id])->first();
        $comment_plus->fill($data);

        if($comment_plus->update()) {

            $comment_pluses = CommentPlus::all();
            $languages = Language::all();

            return view('admin.comment_pluses.comment_pluses_table')->with([
                'comment_pluses' => $comment_pluses,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id) {
 
        $comment_plus = CommentPlus::where(['id' => $id])->first();

        foreach ($comment_plus->coms_comt_pluses as $i) {
            $i->delete();
        }

        if($comment_plus->delete()) {

            $comment_pluses = CommentPlus::all();
            $languages = Language::all();

            return view('admin.comment_pluses.comment_pluses_table')->with([
                'comment_pluses' => $comment_pluses,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function public(Request $request) {
        $comment_plus = CommentPlus::where(['id' => $request->id])->first();

        if($comment_plus->public == false){
            $status = 'yes';
            $comment_plus['public'] = true;
        } else {
            $status = 'no';
            $comment_plus['public'] = false; 
        }

        if($comment_plus->update()) {
            return $status;
        }
    }
}
