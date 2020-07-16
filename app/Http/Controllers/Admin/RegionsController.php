<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Specie;
use App\Language;
use Gate;
use App\Region;
use App\Country;
use Img;


class RegionsController extends Controller
{
    public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
        
        $regions = Region::all();
        $countries = Country::where(['language_id' => $language_id])->get(); 

        return view('admin.regions.regions-view')->with([
            'languages' => $languages,
            'species' => $species,
            'regions' => $regions,
            'countries' => $countries
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

        // Image ================================================================================
        if($request->hasFile('image')) {
            
            $image = $request->file('image');
            $fileName = time() . '-' . $image->getClientOriginalName();

            $img = Img::make($image->getRealPath())
                ->save(public_path().'/images/region/'. $fileName);

            $data['image'] = $fileName;
        }
        // End Image ================================================================================


        if($request->public){
            $data['public'] = true;
        }
        $data['language_id'] = $request->language_id;
        $data['country_id'] = $request->country_id;

        $region = new Region;
        $region->fill($data);

        if($region->save()) {

            $regions = Region::all();
            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $countries = Country::where(['language_id' => $language_id])->get(); 
            return view('admin.regions.regions_table')->with([
                'regions' => $regions,
                'languages' => $languages,
                'success_message' => 'Добавлено!!',
                'countries' => $countries
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


    public function update(Request $request, $region) {
        //dd($request);

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;

        if($request->image){
            $data['image'] = $request->image;
        } else {
            $data['image'] = $request->old_img;
        }
        
        if($request->public){
            $data['public'] = true;
        }
        
        $data['language_id'] = $request->language_id;
        $data['country_id'] = $request->country_id;

        $region = Region::where(['id' => $request->id])->first();
        $region->fill($data);

        if($region->update()) {

            $regions = Region::all();
            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $countries = Country::where(['language_id' => $language_id])->get(); 
            return view('admin.regions.regions_table')->with([
                'regions' => $regions,
                'languages' => $languages,
                'countries' => $countries
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id)
    {
        $region = Region::where(['id' => $id])->first();

        if($region->delete()) {

            $regions = Region::all();
            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
            $countries = Country::where(['language_id' => $language_id])->get(); 
            return view('admin.regions.regions_table')->with([
                'regions' => $regions,
                'languages' => $languages,
                'countries' => $countries
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function public(Request $request) {
        $region = Region::where(['id' => $request->id])->first();

        if($region->public == false){
            $status = 'yes';
            $region['public'] = true;
        } else {
            $status = 'no';
            $region['public'] = false; 
        }

        if($region->update()) {
            return $status;
        }
    }
}
