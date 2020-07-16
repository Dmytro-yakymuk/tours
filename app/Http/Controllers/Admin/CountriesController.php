<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Country;
use App\Specie;
use App\Language;
use Gate;

class CountriesController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 

        $countries = Country::all();

        return view('admin.countries.countries-view')->with([
            'languages' => $languages,
            'species' => $species,
            'countries' => $countries,
            'role_permissions' => $countries[0]
        ]);
    }

    public function create() { }

    public function store(Request $request) {

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $data['language_id'] = $request->language_id;

        $country = new Country;
        $country->fill($data);

        if($country->save()) {

            $countries = Country::all();
            $languages = Language::all();
            return view('admin.countries.countries_table')->with([
                'countries' => $countries,
                'languages' => $languages,
                'success_message' => 'Добавлено!!'
            ])->render();

        }
    }

    public function show($id) { }

    public function edit($id) { }

    public function update(Request $request, $id) {
        
        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $data['language_id'] = $request->language_id;

        $country = Country::where(['id' => $id])->first();
        $country->fill($data);

        if($country->update()) {

            $countries = Country::all();
            $languages = Language::all();
            return view('admin.countries.countries_table')->with([
                'countries' => $countries,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $country = Country::where(['id' => $id])->first();

        if($country->delete()) {

            $countries = Country::all();
            $languages = Language::all();
            return view('admin.countries.countries_table')->with([
                'countries' => $countries,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }
}
