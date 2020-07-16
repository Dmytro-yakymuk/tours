<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany('App\Role', 'roles_users');
    }

    // public function comment() {
    //     return $this->hasMany('App\Comment');
    // }

    // $permission -> 'string' or 'array'
    // $require поверне true коли користувач має всі права і false якщо хоть 1 право має
    public function canDo($permission, $require = FALSE) {
        if(is_array($permission)) {
            $permName = $this->canDo($permName);

            // істина і істина
            if($permName && !$require) {
                return TRUE;
            }

            //  false i false
            else if(!$permName && $require) {
                return FALSE;
            } 
        } else {
            foreach($this->roles as $role) {
                foreach($role->permissions as $perm) {
                    // спочатку передається маска а потім перевірочна строка
                    if(str_is($permission, $perm->name)) {
                        return TRUE;
                    }
                }
            }
        }
    }

    public function hasRole($name, $require = FALSE) {
        if(is_array($name)) {
            foreach($name as $nam) {
                $rol = $this->hasRole($nam);

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

    public function changeRole($input) {
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
