<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'start_date', 'end_date', 'tour_id', 'message', 'public', 'color', 'icon'];

}
