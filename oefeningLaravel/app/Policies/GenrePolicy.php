<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * @OA\SecurityScheme(
 *     securityScheme="api_key",
 *     type="apiKey",
 *     in="header",
 *     name="api_key"
 * )
 * @OA\SecurityScheme(
 *      securityScheme="genre_auth",
 *      type="apiKey",
 *     @OA\Flow(
 *     flow="password",
 *     tokenUrl="/api/login",
 *     scopes={}
 *     )
 *  )
 */

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
