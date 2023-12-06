<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Access\Response;

class GenrePolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): Response
    {
        return $user->user_role_id === 2
            ? Response::allow()
            : Response::deny('You are not authorized to update a genre.');
    }
}
