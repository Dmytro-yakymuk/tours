<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComsComtPlus extends Model
{
    protected $table = 'coms_comt_pluses';

    protected $fillable = [
        'id', 'comment_id', 'comment_plus_id', 'created_at', 'updated_at'
    ];
}
