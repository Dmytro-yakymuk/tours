<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $fillable = [
        'id', 'name', 'slug', 'image', 'public', 'language_id', 'country_id', 'created_at', 'updated_at'
    ];

    public function tours() {
        // hasMany - звязок 1 до багатьох
        $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        return $this->hasMany('App\Tour')->where(['public' => true, 'language_id' => $language_id]);
    }

    public function getRegionCount(){
        $count = $this->tours;
        return count($count);
    }

    public function country() {
    	return $this->belongsTo('App\Country', 'country_id', 'id');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }

}
