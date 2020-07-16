<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id', 'name', 'title', 'created_at', 'updated_at'
    ];

    public function users() {
        // hasMany - звязок багато до багатьох    через таблицю
        return $this->belongsToMany('App\User', 'roles_users');
    }

    public function permissions() {
        // hasMany - звязок багато до багатьох    через таблицю
        return $this->belongsToMany('App\Permission', 'permission_roles');
    }
}
