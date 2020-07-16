<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{

    protected $fillable = [
        'id', 'name', 'slug', 'icon', 'public', 'language_id', 'created_at', 'updated_at'
    ];

    public function categories() {
        return $this->hasMany('App\Category');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
