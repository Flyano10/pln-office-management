<?php

namespace App\Policies;

use App\Models\PlnOffice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlnOfficePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, PlnOffice $office)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, PlnOffice $office)
    {
        return $user->isAdmin();
    }
}
