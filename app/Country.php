<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = [
        'id', 'name', 'slug', 'language_id', 'created_at', 'updated_at'
    ];

    public function regions() {
        // hasMany - звязок 1 до багатьох
        return $this->hasMany('App\Region');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
