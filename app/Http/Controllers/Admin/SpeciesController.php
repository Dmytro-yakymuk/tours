<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\SpecieRequest;
use App\Specie;
use App\Language;
use Gate;
use Calendar;
use App\Event;

class SpeciesController extends Controller
{

    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
        
        $species_view = Specie::all();

        return view('admin.species.species-view')->with([
            'languages' => $languages,
            'species' => $species,
            'species_view' => $species_view
        ]);
    }


    public function create()
    {
        //
    }


    public function store(SpecieRequest $request)
    {

        if(Gate::denies('create', new Specie)) {
            abort(403, 'Немає прав на додавання видів турів!!!');
        }

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;

        $specie = new Specie;
        $specie->fill($data);

        if($specie->save()) {

            $species_view = Specie::all();
            $languages = Language::all();
            return view('admin.species.species_table')->with([
                'species_view' => $species_view,
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


    public function update(SpecieRequest $request, $specie) {
        //dd($request);

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;

        $specie = Specie::where(['id' => $request->id])->first();
        $specie->fill($data);

        if($specie->update()) {

            $species_view = Specie::all();
            $languages = Language::all();
            return view('admin.species.species_table')->with([
                'species_view' => $species_view,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $specie = Specie::where(['id' => $id])->first();

        if($specie->delete()) {

            $species_view = Specie::all();
            $languages = Language::all();
            return view('admin.species.species_table')->with([
                'species_view' => $species_view,
                'languages' => $languages
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function public(Request $request) {
        $specie = Specie::where(['id' => $request->id])->first();

        if($specie->public == false){
            $status = 'yes';
            $specie['public'] = true;
        } else {
            $status = 'no';
            $specie['public'] = false; 
        }

        if($specie->update()) {
            return $status;
        }
    }


}
