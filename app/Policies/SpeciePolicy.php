<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpeciePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    
    public function view(User $user) {
        return $user->canDo('VIEW_SPECIE');
    }

    public function create(User $user) {
        return $user->canDo('CREATE_SPECIE');
    }

    public function update(User $user) {
        return $user->canDo('UPDATE_SPECIE');
    }

    public function delete(User $user) {
        return $user->canDo('DELETE_SPECIE');
    }

}
