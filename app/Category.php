<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'id', 'name', 'slug', 'public', 'language_id', 'specie_id', 'created_at', 'updated_at'
    ];
    
    public function tours() {
        // hasMany - звязок 1 до багатьох
        // $language_id = Language::select('id')->where('locale', session('language'))->first()->id;
        // $specie_id = Specie::select('id')->where(['public' => true, 'language_id' => $language_id, 'slug' => session('specie')])->first()->id;
        // return $this->hasMany('App\Tour')->where(['public' => true, 'language_id' => $language_id, 'specie_id' => $specie_id]);
        
        return $this->hasMany('App\Tour');
    }

    public function getCategoryCount(){
        $count = $this->tours;
        return count($count);
    }


    public function specie() {
        return $this->belongsTo('App\Specie');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
