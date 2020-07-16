<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourIcon extends Model
{
    protected $table = 'tour_icons';

    protected $fillable = [
        'id', 'tour_id', 'icon_id', 'created_at', 'updated_at'
    ];
}
