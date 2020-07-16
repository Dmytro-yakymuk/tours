<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Specie;
use App\Language;
use Gate;
use App\Category;

class CategoriesController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
        
        $categories = Category::all();

        return view('admin.categories.categories-view')->with([
            'languages' => $languages,
            'species' => $species,
            'categories' => $categories
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {


        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;
        $data['specie_id'] = $request->specie_id;

        $category = new Category;
        $category->fill($data);

        if($category->save()) {

            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
            $categories = Category::all();
            $languages = Language::all();
            return view('admin.categories.categories_table')->with([
                'categories' => $categories,
                'languages' => $languages,
                'species' => $species,
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


    public function update(Request $request, $category) {
        //dd($request);

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;
        $data['specie_id'] = $request->specie_id;

        $category = Category::where(['id' => $request->id])->first();
        $category->fill($data);

        if($category->update()) {

            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
            $categories = Category::all();
            $languages = Language::all();
            return view('admin.categories.categories_table')->with([
                'categories' => $categories,
                'languages' => $languages,
                'species' => $species
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $category = Category::where(['id' => $id])->first();

        if($category->delete()) {

            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
            $categories = Category::all();
            $languages = Language::all();
            return view('admin.categories.categories_table')->with([
                'categories' => $categories,
                'languages' => $languages,
                'species' => $species
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function public(Request $request) {
        $category = Category::where(['id' => $request->id])->first();

        if($category->public == false){
            $status = 'yes';
            $category['public'] = true;
        } else {
            $status = 'no';
            $category['public'] = false; 
        }

        if($category->update()) {
            return $status;
        }
    }
}
