<?php

namespace App\Policies;

use App\Models\Form;
use App\Models\User;

class FormPol
{
    public function __construct()
    {

    }

    public function view(User $user){
           return $user->hasPermission('view_form');
    }

    public function create(User $user){
        return $user->hasPermission('create_form');
    }

    public function edit(User $user,Form $form){
        // return $user->hasPermission('edit_form') || $form->user_id == $user->id;
        return $user->hasPermission('edit_form') || $user->isOwner($form);
        // return $user->hasPermission('edit_form') || ($user->isOwner($form) && $user->hasPermission('edit_own_form'));
    }

    public function delete(User $user,Form $form){
        return $user->hasPermission('delete_form') || $user->isOwner($form);
    }
}
