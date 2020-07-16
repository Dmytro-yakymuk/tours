<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{

    protected $fillable = [
        'id', 'icon', 'text', 'room', 'public', 'language_id', 'created_at', 'updated_at'
    ];

    public function one_icon()
    {
        //           багато до багатьох        через таблицю
        return $this->belongsToMany('App\Tour', 'tour_icons');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
