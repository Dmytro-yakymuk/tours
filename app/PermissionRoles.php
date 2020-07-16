<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRoles extends Model
{
    protected $fillable = [
        'id', 'role_id', 'permission_id', 'created_at', 'updated_at'
    ];
}
