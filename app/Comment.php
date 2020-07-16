<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id', 'text', 'country', 'rating', 'public', 'created_at', 'updated_at', 'tour_id', 'user_id'
    ];


    public function coms_comt_pluses_true() {
        return $this->belongsToMany('App\CommentPlus', 'coms_comt_pluses')->where(['public' => 1, 'position' => 1]);
    }

    public function coms_comt_pluses_false() {
        return $this->belongsToMany('App\CommentPlus', 'coms_comt_pluses')->where(['public' => 1, 'position' => 0]);
    }

    public function commentplus() {
        return $this->hasMany('App\ComsComtPlus');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
