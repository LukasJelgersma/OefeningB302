<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 * )
 */

class GenrePolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): Response
    {
        return $user->user_role_id === 1
            ? Response::allow()
            : Response::deny('You are not authorized to update a genre.');
    }

/**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user): Response
    {
        return $user->user_role_id === 1
            ? Response::allow()
            : Response::deny('You are not authorized to delete a genre.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function store(User $user): Response
    {
        return $user->user_role_id === 1
            ? Response::allow()
            : Response::deny('You are not authorized to restore a genre.');
    }
}
