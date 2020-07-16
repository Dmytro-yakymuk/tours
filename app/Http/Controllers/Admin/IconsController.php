<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Specie;
use App\Language;
use Gate;
use App\Icon;
use Img;

class IconsController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
        
        $icons = Icon::all();

        return view('admin.icons.icons-view')->with([
            'languages' => $languages,
            'species' => $species,
            'icons' => $icons
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $data['text'] = $request->text;

        // Icon ================================================================================
        if($request->hasFile('icon')) {
            
            $icon = $request->file('icon');
            $fileName = time() . '-' . $icon->getClientOriginalName();

            $img = Img::make($icon->getRealPath())
                ->save(public_path().'/images/'. $fileName);

            $data['icon'] = $fileName;
        }
        // End Icon ================================================================================


        if($request->room){
            $data['room'] = true;
        }

        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;

        $icon = new Icon;
        $icon->fill($data);

        if($icon->save()) {

            $icons = Icon::all();
            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

            return view('admin.icons.icons_table')->with([
                'icons' => $icons,
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
        //dd($request);

        $data['text'] = $request->text;

        if($request->hasFile('icon')) {
            
            $icon = $request->file('icon');
            $fileName = time() . '-' . $icon->getClientOriginalName();

            $img = Img::make($icon->getRealPath())
                ->save(public_path().'/images/'. $fileName);

            $data['icon'] = $fileName;
        } else {
            $data['icon'] = $request->old_img;
        }
        
        if($request->room){
            $data['room'] = true;
        }

        if($request->public){
            $data['public'] = true;
        }
        
        $data['language_id'] = $request->language_id;

        $icon = Icon::where(['id' => $request->id])->first();
        $icon->fill($data);

        if($icon->update()) {

            $icons = Icon::all();
            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

            return view('admin.icons.icons_table')->with([
                'icons' => $icons,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $icon = Icon::where(['id' => $id])->first();

        if($icon->delete()) {

            $icons = Icon::all();
            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

            return view('admin.icons.icons_table')->with([
                'icons' => $icons,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function room(Request $request) {
        $icon = Icon::where(['id' => $request->id])->first();

        if($icon->room == false){
            $status = 'yes';
            $icon['room'] = true;
        } else {
            $status = 'no';
            $icon['room'] = false; 
        }

        if($icon->update()) {
            return $status;
        }
    }

        public function public(Request $request) {
        $icon = Icon::where(['id' => $request->id])->first();

        if($icon->public == false){
            $status = 'yes';
            $icon['public'] = true;
        } else {
            $status = 'no';
            $icon['public'] = false; 
        }

        if($icon->update()) {
            return $status;
        }
    }
}
