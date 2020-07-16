<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'id', 'email', 'created_at', 'updated_at'
    ];
}
