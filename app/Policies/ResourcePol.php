<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Resource;

class ResourcePol
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user){
        return $user->hasPermission('view_resource');
    }

    public function create(User $user){
        return $user->hasPermission('create_resource');
    }

    public function edit(User $user,Resource $resource){
        return $user->hasPermission('edit_resource');
    }

    public function delete(User $user,Resource $resource){
        return $user->hasPermission('delete_resource');
    }
}
