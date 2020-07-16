<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'id', 'name', 'tour_id', 'created_at', 'updated_at'
    ];
    public function tour() {
        return $this->belongTo('App\Tour');
    }
}
