<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Tour;
use App\Country;
use App\Region;
use App\Specie;
use App\Currency;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'home';
        $languages = Language::all();
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get();
        $tours = Tour::where(['public' => true, 'language_id' => $language_id])->limit(6)->get();
        $tours_count = Tour::count();
        $countries_top = Country::where(['language_id' => $language_id])->limit(3)->get();
        $regions = Region::where(['public' => true, 'language_id' => $language_id])->limit(6)->get();
        $countries = Country::where(['language_id' => $language_id])->get();
        $currencies = Currency::all();

        return view('index')->with([
            'languages' => $languages,
            'species' => $species,
            'tours' => $tours,
            'countries_top' => $countries_top,
            'countries' => $countries,
            'regions' => $regions,
            'tours_count' => $tours_count,
            'menu' => $menu,
            'currencies' => $currencies
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
}
