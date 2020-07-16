<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentPlus extends Model
{
    protected $table = 'comment_pluses';

    protected $fillable = [
        'id', 'name', 'position', 'public', 'language_id', 'created_at', 'updated_at'
    ];


    public function coms_comt_pluses() {
        return $this->hasMany('App\ComsComtPlus');
    }
}
