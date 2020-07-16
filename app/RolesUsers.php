<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesUsers extends Model
{
    protected $table = 'roles_users';

    protected $fillable = [
        'id', 'role_id', 'user_id', 'created_at', 'updated_at'
    ];
}
