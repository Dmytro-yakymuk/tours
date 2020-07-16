<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'id', 'name', 'addition', 'position', 'public', 'language_id', 'created_at', 'updated_at'
    ];

    protected $tour_id;

    public function tour_service() {
    	return $this->belongsTo('App\TourService', 'id', 'service_id')->where('tour_id', $this->tour_id);
    }

    public function getService($tour_id) {
        $this->tour_id = $tour_id;
        return $this->tour_service;
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
