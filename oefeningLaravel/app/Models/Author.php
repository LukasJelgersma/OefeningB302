<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     title="Author",
 *     description="Author model",
 *     @OA\Xml(
 *     name="Author"
 *    )
 * )
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable =[
        'author_id',
        'name',
        'age',
        'createdAt',
        'updatedAt'
    ];

    /**
     * The books that belong to the author
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * @OA\Property(
     *     title="Author name",
     *     description="Author name",
     *     example="J.K. Rowling"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Author age",
     *     description="Author age",
     *     example="55"
     * )
     *
     * @var string
     */
    private $age;

}
