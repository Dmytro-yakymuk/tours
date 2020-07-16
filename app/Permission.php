<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    
    protected $fillable = [
        'id', 'name', 'title', 'created_at', 'updated_at'
    ];

    
    public function roles() {
        return $this->belongsToMany('App\Role', 'permission_roles');
    }

    public function hasPermission($name, $require = FALSE) {
        if(is_array($name)) {
            foreach($name as $nam) {
                $rol = $this->hasPermission($nam);

                if($rol && !$require) {
                    return TRUE;
                }

                if(!$rol && $require) {
                    return FALSE;
                }
            }
        } else {
            foreach ($this->roles as $role) {
                if($role->name == $name) {
                    return TRUE;
                }
            }
        } 
    }

    public function changePermission($input) {
        if(!empty($input)) {
            // sync обновлює дані 
            $this->roles()->sync($input);
        } else {
            // detach відвязує цілого користувача
            $this->roles()->detach(); 
        }

        return TRUE;
    }
}
