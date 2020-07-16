<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Specie;
use App\Language;
use Gate;
use App\Service;

class ServicesController extends Controller
{
     public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
        
        $services = Service::all();

        return view('admin.services.services-view')->with([
            'languages' => $languages,
            'species' => $species,
            'services' => $services
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request) {

        $data['name'] = $request->name;
        if($request->addition){
            $data['addition'] = $request->addition;
        }
        $data['position'] = $request->position;
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;

        $service = new Service;
        $service->fill($data);

        if($service->save()) {

            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
            $languages = Language::all();

            $services = Service::all();
            
            return view('admin.services.services_table')->with([
                'services' => $services,
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


    public function update(Request $request, $id) {
        //dd($request);

        $data['name'] = $request->name;
        if($request->addition){
            $data['addition'] = $request->addition;
        }
        $data['position'] = $request->position;
        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;

        $service = Service::where(['id' => $id])->first();
        $service->fill($data);

        if($service->update()) {

            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
            $languages = Language::all();

            $services = Service::all();
            return view('admin.services.services_table')->with([
                'services' => $services,
                'languages' => $languages,
                'species' => $species
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $service = Service::where(['id' => $id])->first();

        if($service->delete()) {

            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
            $languages = Language::all();

            $services = Service::all();
            return view('admin.services.services_table')->with([
                'services' => $services,
                'languages' => $languages,
                'species' => $species
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function public(Request $request) {
        $service = Service::where(['id' => $request->id])->first();

        if($service->public == false){
            $status = 'yes';
            $service['public'] = true;
        } else {
            $status = 'no';
            $service['public'] = false; 
        }

        if($service->update()) {
            return $status;
        }
    }
}
