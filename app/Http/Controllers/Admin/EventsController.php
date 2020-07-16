<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Specie;
use App\Language;
use Gate;
use App\Event;
use Img;
use App\Tour;

class EventsController extends Controller
{
     public function index() {

        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        $languages = Language::all();
        $species = Specie::where(['public' => true, 'language_id' => $language_id])->get(); 
        
        $events = Event::all();
        $tours = Tour::all();

        return view('admin.events.events-view')->with([
            'languages' => $languages,
            'species' => $species,
            'events' => $events,
            'tours' => $tours
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request) {
        //dd($request);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['tour_id'] = $request->tour_id;
        $data['message'] = $request->message;

        if($request->public){
            $data['public'] = true;
        }

        // Icon ================================================================================
        if($request->hasFile('icon')) {
            
            $icon = $request->file('icon');
            $fileName = time() . '-' . $icon->getClientOriginalName();

            $img = Img::make($icon->getRealPath())
                ->save(public_path().'/images/'. $fileName);

            $data['icon'] = $fileName;
        }
        // End Icon ================================================================================


        $event = new Event;
        $event->fill($data);

        if($event->save()) {

            $events = Event::all();
            $tours = Tour::all();

            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

            return view('admin.events.events_table')->with([
                'events' => $events,
                'languages' => $languages,
                'success_message' => 'Добавлено!!',
                'tours' => $tours
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
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['tour_id'] = $request->tour_id;
        $data['message'] = $request->message;

        if($request->public){
            $data['public'] = true;
        }

        // Icon ================================================================================
        if($request->hasFile('icon')) {
            
            $icon = $request->file('icon');
            $fileName = time() . '-' . $icon->getClientOriginalName();

            $img = Img::make($icon->getRealPath())
                ->save(public_path().'/images/'. $fileName);

            $data['icon'] = $fileName;
        } else {
            $data['icon'] = $request->old_img;
        }
        // End Icon ================================================================================



        $event = Event::where(['id' => $request->id])->first();
        $event->fill($data);

        if($event->update()) {

            $events = Event::all();
            $tours = Tour::all();

            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

            return view('admin.events.events_table')->with([
                'events' => $events,
                'languages' => $languages,
                'tours' => $tours
            ])->render();

        } else {
            return 'Помилка';  
        }
    }


    public function destroy($id) {
        $event = Event::where(['id' => $id])->first();

        if($event->delete()) {

            $events = Event::all();
            $tours = Tour::all();

            $languages = Language::all();
            $language_id = Language::select('id')->where('locale', session('language'))->first()->id;

            return view('admin.events.events_table')->with([
                'events' => $events,
                'languages' => $languages,
                'tours' => $tours
            ])->render();

        } else {
            return 'Помилка';  
        }
    }

    public function public(Request $request) {
        $event = Event::where(['id' => $request->id])->first();

        if($event->public == false){
            $status = 'yes';
            $event['public'] = true;
        } else {
            $status = 'no';
            $event['public'] = false; 
        }

        if($event->update()) {
            return $status;
        }
    }
}
