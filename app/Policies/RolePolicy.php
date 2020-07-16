<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
        return $user->canDo('VIEW_ROLE');
    }

    public function create(User $user) {
        return $user->canDo('CREATE_ROLE');
    }

    public function update(User $user) {
        return $user->canDo('UPDATE_ROLE');
    }

    public function delete(User $user) {
        return $user->canDo('DELETE_ROLE');
    }
}
