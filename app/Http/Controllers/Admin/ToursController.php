<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tour;
use App\Language;
use App\Country;
use App\Region;

use App\Specie;
use Img;
use Illuminate\Support\Facades\Input;
use App\Icon;
use App\Service;
use App\Plus;
use App\Image;
use Illuminate\Support\Facades\Storage;
use App\TourService;
use App\TourIcon;


class ToursController extends Controller
{

    public function index($specie) {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $specie_id = Specie::select('id')->where(['public' => true, 'language_id' => $language_id, 'slug' => $specie ])->first()->id;
        
        $tours = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id])->get();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
        return view('admin.tours.tours')->with([
            'tours' => $tours,
            'specie' => $specie,
            'species' => $species
        ]);
    }


    public function create($specie) {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();

        $countries = Country::where(['language_id' => $language_id])->get();
        $regions = Region::where(['public' => true, 'language_id' => $language_id])->get();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get();

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $icons = Icon::where(['public' => true, 'language_id' => $language_id])->get();
        $services = Service::where(['public' => true, 'language_id' => $language_id])->orderBy('position')->get();


        return view('admin.tours.tours-add')->with([
            'countries' => $countries,
            'regions' => $regions,
            'specie' => $specie,
            'species' => $species,
            'languages' => $languages,
            'specie' => $specie,
            'icons' => $icons,
            'services' => $services,
            'locale' => session('language')
        ]);
    }


    public function store(Request $request)
    {
        //dd($request);

        $data['title'] = $request->title;

		if(!empty($data['title'])) {
			$data['slug'] = str_slug($data['title']);
        }

        $data['description'] = $request->description;
        $data['text'] = $request->text;


        
        // Image ================================================================================
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '-' . $image->getClientOriginalName();

            $img = Img::make($image->getRealPath())
                ->crop($request->width, $request->height, $request->x, $request->y)
                ->save(public_path().'/images/test/'. $fileName);

            $data['image'] = $fileName;
        }
        // End Image ================================================================================

        if($request->public){
            $data['public'] = true;
        }
        if($request->new){
            $data['new'] = true;
        }
        if($request->sold){
            $data['sold'] = true;
        }
        if($request->root){
            $data['root'] = true;
        }

      
        $data['specie_id'] =$specie_id;

        $data['region_id'] = $request->region_id;
        $data['language_id'] = $request->language_id;

        $data['price_discount'] = $request->price_discount;
        $data['discount'] = $request->discount;
        $data['price'] = $request->price;

        $data['rating'] = 5;

        $tour = new Tour;
        $tour->fill($data);

        if($tour->save()) {
            $tour_id = Tour::select('id')->where('slug', $data['slug'])->first()->id;
            return [
                'status' => 'yes',
                'tour_id' => $tour_id
            ];
        } else {
            return 'Помилка';  
        }
    }

    public function store2(Request $request) {

        $tour = Tour::where('id', $request->tour_id)->first();

        // Icons ================================================================================
        foreach ($tour->tour_icons as $i) {
            $i->delete();
        }

        foreach ($request->icons as $icon_id) {
            $item_icon['tour_id'] = $tour->id;
            $item_icon['icon_id'] = $icon_id;

            $tour_icon = new TourIcon;
            $tour_icon->fill($item_icon);
            $tour_icon->save();
        }
        // End icons ===============================================================================

        // Services ================================================================================
        foreach ($tour->tour_services as $s) {
            $s->delete();
        }

        foreach ($request->stan as $key => $service_price) {
            $item_service['tour_id'] = $tour->id;
            $item_service['service_id'] = $key;
            $item_service['price'] = $service_price;

            $tour_service = new TourService;
            $tour_service->fill($item_service);
            $tour_service->save();
        }
        // End services ================================================================================

        return 'yes';
    }




    public function edit($specie, $slug) {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();

        $tour = Tour::where(['public' => true, 'language_id' => $language_id, 'slug' => $slug])->first();

        $countries = Country::where(['language_id' => $language_id])->get();
        $regions = Region::where(['public' => true, 'language_id' => $language_id])->get();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get();
   
        $icons_selected = $tour->icons->where('language_id', $language_id);
        foreach ($icons_selected as $key => $icons_sel) {
            $icons_id[$key] = $icons_sel->id;
        }
        $icons = Icon::where(['public' => true, 'language_id' => $language_id])->whereNotIn('id', $icons_id)->get();

        $tour_services = $tour->services;
        foreach ($tour_services as $key => $tour_serv) {
            $tour_id[$key] = $tour_serv->id;
        }

        $services = Service::where(['public' => true, 'language_id' => $language_id])->orderBy('position')->get();

        foreach ($services as $key => $service) {
            $service['service_price'] = $service->getService($tour->id);
        }

        $plus_romm = Plus::where(['public' => true, 'language_id' => $language_id, 'room' => 0])->get();
        $plus = Plus::where(['public' => true, 'language_id' => $language_id, 'tour_id' => $tour->id])->get();

        return view('admin.tours.tours-edit')->with([
            'tour' => $tour,
            'countries' => $countries,
            'regions' => $regions,
            'specie' => $specie,
            'species' => $species,
            'icons' => $icons,
            'icons_selected' => $icons_selected,
            'languages' => $languages,
            'services' => $services,
            'tour_services' => $tour_services,
            'plus_romm' => $plus_romm,
            'plus' => $plus,
            'locale' => session('language')

        ]);
    }


    public function update(Request $request, $specie, $id) {

        // if(Gate::denies('create', $this->model)) {
		// 	abort(403);
        // }
        
        //dd($request);
        $tour = Tour::where('id', $id)->first();

		$data['title'] = $request->title;

		if(!empty($data['title'])) {
			$data['slug'] = str_slug($data['title']);
        }

        $data['description'] = $request->description;
        $data['text'] = $request->text;


        
        // Image ================================================================================
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '-' . $image->getClientOriginalName();

            $img = Img::make($image->getRealPath())
                ->crop($request->width, $request->height, $request->x, $request->y)
                ->save(public_path().'/images/test/'. $fileName);

            $data['image'] = $fileName;
        } else {
            $data['image'] = $request->old_img;
        }
        // End Image ================================================================================

        if($request->public){
            $data['public'] = true;
        }
        if($request->new){
            $data['new'] = true;
        }
        if($request->sold){
            $data['sold'] = true;
        }
        if($request->root){
            $data['root'] = true;
        }
        
        

        $data['specie_id'] =$specie_id;

        $data['region_id'] = $request->region_id;
        $data['language_id'] = $request->language_id;


        $data['price_discount'] = $request->price_discount;
        $data['discount'] = $request->discount;
        $data['price'] = $request->price;

        // Icons ================================================================================
        foreach ($tour->tour_icons as $i) {
            $i->delete();
        }

        foreach ($request->icons as $icon_id) {
            $item_icon['tour_id'] = $id;
            $item_icon['icon_id'] = $icon_id;

            $tour_icon = new TourIcon;
            $tour_icon->fill($item_icon);
            $tour_icon->save();
        }
        // End icons ===============================================================================

        //dd($request);

        // Services ================================================================================
        foreach ($tour->tour_services as $s) {
            $s->delete();
        }

        $services_count = Service::count();
        for($i = 1; $i <= $services_count; $i++) {

            $stan = 'stan'.$i;
            $service_price = 'service_price'.$i;

            if($request[$stan]) {
                $item_service['tour_id'] = $id;
                $item_service['service_id'] = $request[$stan];
                $item_service['price'] = $request[$service_price];

                $tour_service = new TourService;
                $tour_service->fill($item_service);
                $tour_service->save();
            }
        }
        // End services ================================================================================

        $data['rating'] = 5;

        $tour->fill($data);
        if($tour->update()) {
            return redirect()->route('admin.tours.index', ['specie' => $tour->specie->slug])->with(['status' => 'Матеріал обновлений']);
        } else {
            return back()->with(['error' => 'Даний псевдонім вже використовується']);  
        }
        
    }


    public function destroy($id) {

        $tour = Tour::where('id', $id)->first();

        $plus = Plus::where('tour_id', $id)->get();
        if($plus->isNotEmpty()){
            if(count($plus) > 0){
                foreach ($plus as $pl) {
                    $pl->delete();  
                }
            } else {
                $plus->delete();
            }
        }
        
        $tour_icon = TourIcon::where('tour_id', $id)->get();
        if($tour_icon->isNotEmpty()){
            if(count($tour_icon) > 0){
                foreach ($tour_icon as $icon) {
                    $icon->delete();  
                }
            } else {
                $tour_icon->delete();
            }
        }

        $tour_service = TourService::where('tour_id', $id)->get();
        if($tour_service->isNotEmpty()){
            if(count($tour_service) > 0){
                foreach ($tour_service as $service) {
                    $service->delete();  
                }
            } else {
                $tour_service->delete();
            }
        }

        $images = Image::where('tour_id', $id)->get();
        if($images->isNotEmpty()){
            if(count($images) > 0){
                foreach ($images as $image) {
                    $image->delete();  
                }
            } else {
                $images->delete();
            }
        }


        if($tour->delete()) {
            return back()->with(['status' => 'Матеріал обновлений']);
        }
    }


    public function images_view($id) {
        $images = Image::where('tour_id', $id)->get();

        return view('admin.tours.tour_images')->with([
            'images' => $images
        ])->render();
    }


    public function images_upload(Request $request, $id) {
        
        foreach ($request->images as $key => $image) {
            $tour = Tour::where('id', $id)->first();

            $fileName = time() . '-' . $image->getClientOriginalName();
            $img = Img::make($image->getRealPath())
                ->save(public_path().'/images/test/'. $fileName);

            $data['name'] = $fileName;
            $data['tour_id'] = $id;

            $image = new Image;
            $image->fill($data);
            $image->save();
            $img->destroy();
            
        }
        
        return response()->json([
            "message" => "Done"
        ]);
    }


    public function image_destroy(Request $request) {
        $image = Image::where('name', $request->image_name)->first();

        if($image->delete()) {
            //Storage::delete(public_path().'/images/test/'. $request->image_name);
            $images = Image::where('tour_id', $request->tour_id)->get();

            return view('admin.tours.tour_images')->with([
                'images' => $images
            ])->render();
        }
    }


    public function images_destroy(Request $request) {
        $images = Image::where('tour_id', $request->tour_id)->get();

        foreach ($images as $image) {
            if($image->delete()) {
                //Storage::delete(public_path().'/images/test/'. $request->image_name);
            }
        }

        $images_view = Image::where('tour_id', $request->tour_id)->get();
        return view('admin.tours.tour_images')->with([
            'images' => $images_view
        ])->render();
    }    
}
