<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     title="Genre",
 *     description="Genre model",
 *     @OA\Xml(
 *     name="Genre"
 *    )
 * )
 */

class Genre extends Model
{
    use HasFactory;
    /**
     * The books that belong to the genre
     */
    protected $fillable =[
        'genre_id',
        'name',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * @OA\Property(
     *     title="Genre name",
     *     description="Genre name",
     *     example="Fantasy"
     * )
     *
     * @var string
     */
    private $name;
}
