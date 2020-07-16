<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{

    protected $fillable = [
        'id', 'title', 'slug', 'price', 'discount', 'new', 'sold', 'description', 'text', 'image', 'images', 'icon', 'rating', 'root', 'public', 'region_id', 'category_id', 'language_id', 'created_at', 'updated_at'
    ];


    public function region() {
    	// belongsTo - звязок до 1              своє поле   чуже
    	return $this->belongsTo('App\Region', 'region_id', 'id');
    }

    public function icons()
    {
        //           багато до багатьох        через таблицю
        return $this->belongsToMany('App\Icon', 'tour_icons');
    }

    public function tour_icons() {
        return $this->hasMany('App\TourIcon');
    }

    public function services() {
        return $this->belongsToMany('App\Service', 'tour_services');
    }

    public function tour_services() {
        return $this->hasMany('App\TourService');
    }

    public function tour_service() {
    	return $this->belongsTo('App\TourService', 'id', 'service_id');
    }

    public function specie() {
        return $this->belongsTo('App\Specie');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

    
}
