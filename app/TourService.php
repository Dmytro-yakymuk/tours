<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourService extends Model
{
    protected $fillable = [
        'id', 'tour_id', 'service_id', 'price', 'created_at', 'updated_at'
    ];
}
