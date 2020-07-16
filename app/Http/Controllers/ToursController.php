<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Tour;
use App\Region;
use App\Category;
use App\Plus;
use App\Specie;

use Calendar;
use App\Event;
use Carbon\Carbon;
use App\Comment;

use App\Http\Requests\EmailRequest;
use App\Jobs\SubscriptionEmailJob;

use App\Subscription;
use Swap;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($specie)
    {   

        $menu = $specie;
        $languages = Language::all();
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get();
        $regions = Region::where(['public' => true, 'language_id' => $language_id])->get();

        $language_locale = Language::select('locale')->where('locale', session('language'))->first()->locale;


        $specie_id = Specie::select('id')->where(['public' => true, 'language_id' => $language_id, 'slug' => $specie ])->first()->id;
        $specie_name = Specie::select('name')->where(['public' => true, 'language_id' => $language_id, 'slug' => $specie ])->first()->name;
        $tours = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id ])->paginate(9);
        $tours_count = Tour::where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id ])->count();


        foreach ($tours as $tour) {
            $tour['region'] = $tour->region;
            $tour['country'] = $tour->region->country;
        }

        foreach ($regions as $region) {
            $region['tour_count'] = $region->getRegionCount();
        }
 


        return view('tours')->with([
            'languages' => $languages,
            'species' => $species,
            'menu' => $menu,

            'tours' => $tours,
            'regions' => $regions,
            'tours_count' => $tours_count,
            'language_locale' => $language_locale,
            'specie_name' => $specie_name
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
    public function show($specie, $slug) {
        
        $menu = $specie;
        $languages = Language::all();
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

        $tour = Tour::where(['public' => true, 'slug' => $slug, 'language_id' => $language_id])->first();
        
        //'language_id' => $language_id,
        $plus_room = Plus::where(['public' => true, 'tour_id' => $tour->id, 'room' => 0])->get();
        $plus = Plus::where(['public' => true, 'tour_id' => $tour->id])->get();
        
        $icons = $tour->icons->where('language_id', $language_id);
        
        $services = $tour->services->where('language_id', $language_id);

        foreach ($services as $key => $service) {
            $service['service_price'] = $service->getService($tour->id);
        }
        
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get();
        $specie_name = Specie::select('name')->where(['public' => true, 'language_id' => $language_id, 'slug' => $specie ])->first()->name;




        $events = [];
        $data = Event::where(['public' => true])->get();
        
        if($data->count()) {
            foreach ($data as $key => $value) {
                $enddate = $value->end_date."24:00:00";
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day'),
                    $value->id,
                    // Add color and link on event
	                [
	                    'color' => '#f05050'
	                ]
                );
            }
        }
        
        $calendar = Calendar::addEvents($events);

        $comments = Comment::all();


        return view('tour')->with([
            'languages' => $languages,
            'tour' => $tour,
            'plus_room' => $plus_room,
            'plus' => $plus,
            'icons' => $icons,
            'services' => $services,
            'species' => $species,
            'menu' => $menu,
            'specie_name' => $specie_name,
            'calendar' => $calendar,
            'comments' => $comments
            
        ]);

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

    public function event_reserve(Request $request) {
        //dd($request);

        // if(Gate::denies('create', new Specie)) {
        //     abort(403, 'Немає прав на додавання видів турів!!!');
        // }
        
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
        $data['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
        $data['tour_id'] = $request->tour_id;
        $data['message'] = $request->message;
        $data['public'] = false;


        $event = new Event;
        $event->fill($data);

        if($event->save()) {

           return 'yes';

        }
    }


    public function email_subscription(EmailRequest $request) {

        $subscription_check = Subscription::where(['email' => $request->email, 'public' => true])->first();

        if($subscription_check) {
            return 'Ви вже підписані!!!';
        } else {

            $data['email'] = $request->email;
            $data['public'] = true;

            $subscription = new Subscription;
            $subscription->fill($data);

            if($subscription->save()) {

                SubscriptionEmailJob::dispatch($data)->delay(Carbon::now()->addSeconds(10));
                return 'Підписалися!!!';
            }
        }
    }
    
    
}
