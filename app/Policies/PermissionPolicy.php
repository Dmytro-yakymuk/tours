<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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
        return $user->canDo('VIEW_PERMISSIONS');
    }

    public function create(User $user) {
        return $user->canDo('CREATE_PERMISSIONS');
    }

    public function update(User $user) {
        return $user->canDo('UPDATE_PERMISSIONS');
    }

    public function delete(User $user) {
        return $user->canDo('DELETE_PERMISSIONS');
    }
}
