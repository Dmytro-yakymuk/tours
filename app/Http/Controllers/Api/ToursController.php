<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tour;
use App\Language;
use App\Region;
use App\Category;
use App\Specie;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $languages = Language::all();
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $language_locale = Language::select('locale')->where('locale', session('language'))->first()->locale;


        $regions = Region::where(['public' => true, 'language_id' => $language_id])->get();
        $categories = Category::where(['public' => true, 'language_id' => $language_id])->get();


        if(session('specie') == NULL){
            $tours = Tour::where(['public' => true, 'language_id' => $language_id])->paginate(9);
            $tours_count = Tour::count();
        } else {
            $specie_id = Specie::select('id')->where(['public' => true, 'language_id' => $language_id, 'slug' => session('specie')])->first()->id;
            $specie_name = Specie::select('name')->where(['public' => true, 'language_id' => $language_id, 'slug' => session('specie')])->first()->name;
            $tours = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id ])->paginate(9);
            $tours_count = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id ])->count();
            
        }

        // $price_max = Tour::selectRaw('max(price) as price')->where(['public' => true, 'language_id' => $language_id])->first();
        // $price_min = Tour::selectRaw('min(price) as price')->where(['public' => true, 'language_id' => $language_id])->first();




        foreach ($tours as $tour) {
            $tour['region'] = $tour->region;
            $tour['country'] = $tour->region->country;
        }

        foreach ($regions as $region) {
            $region['tour_count'] = $region->getRegionCount();
        }
 
        foreach ($categories as $category) {
            $category['tour_count'] = $category->getCategoryCount();
        }

        return [
            'tours' => $tours,
            'regions' => $regions,
            'categories' => $categories,
            'tours_count' => $tours_count,
            'language_locale' => $language_locale,
            'specie_name' => $specie_name
            // 'price_max' => $price_max,
            // 'price_min' => $price_min
        ];
    }



    public function orderBy(Request $request)
    {


        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $language_locale = Language::select('locale')->where('locale', session('language'))->first()->locale;
        $specie_name = Specie::select('name')->where(['public' => true, 'language_id' => $language_id, 'slug' => session('specie')])->first()->name;

        $regions = Region::where(['public' => true, 'language_id' => $language_id])->get();
        $categories = Category::where(['public' => true, 'language_id' => $language_id])->get();


        
        if($request->order == 'region_id') {
            $tours = Tour::where(['public' => true, 'language_id' => $language_id, 'region_id' => $request->id])->paginate(9);
        } else if($request->order == 'category_id') {
            $tours = Tour::where(['public' => true, 'language_id' => $language_id, 'category_id' => $request->id])->paginate(9);
        } else if(!empty($request->sort)) {
            $tours = Tour::where(['public' => true, 'language_id' => $language_id])->paginate(9);
        } else {
            $tours = Tour::where(['public' => true, 'language_id' => $language_id])->paginate(9);
        }


        foreach ($tours as $tour) {
            $tour['region'] = $tour->region;
            $tour['country'] = $tour->region->country;
        }
        


        foreach ($regions as $region) {
            $region['tour_count'] = $region->getRegionCount();
        }
 
        foreach ($categories as $category) {
            $category['tour_count'] = $category->getCategoryCount();
        }





        return view('tours_render')->with([

            'tours' => $tours,
            'regions' => $regions,
            'categories' => $categories,

            'language_locale' => $language_locale,
            'specie_name' => $specie_name

        ])->render();
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
    public function store(Request $sort)
    {
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $language_locale = Language::select('locale')->where('locale', session('language'))->first()->locale;


        $specie_id = Specie::select('id')->where(['public' => true, 'language_id' => $language_id, 'slug' => session('specie')])->first()->id;
        
        if($sort->region_id) {
            $tours = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id, 'region_id' => $sort->region_id ])->paginate(9);
            $tours_count = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id, 'region_id' => $sort->region_id])->count();
        }
        
        if($sort->category_id) {
            $tours = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id, 'category_id' => $sort->category_id])->paginate(9);
            $tours_count = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id, 'category_id' => $sort->category_id])->count();
        }


        foreach ($tours as $tour) {
            $tour['region'] = $tour->region;
            $tour['country'] = $tour->region->country;
        }


        return [
            'tours' => $tours,
            'tours_count' => $tours_count,
            'language_locale' => $language_locale
        ];
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
