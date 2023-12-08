<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     title="Book",
 *     description="Book model",
 *     @OA\Xml(
 *     name="Book"
 *    )
 * )
 */

class Book extends Model
{
    use HasFactory;
    protected $fillable =[
        'book_id',
        'name',
        'author_id',
        'publication_year',
    ];

    /**
     * The genres that belong to the books
     */
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * The author that the book belongs to
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @OA\Property(
     *     title="Book name",
     *     description="Book name",
     *     example="Harry Potter"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Book publication year",
     *     description="Book publication year",
     *     example="1997"
     * )
     *
     * @var string
     */
    private $publication_year;

    /**
     * @OA\Property(
     *     title="Book author id",
     *     description="Book author id",
     *     example="10"
     * )
     *
     * @var string
     */
    private $author;
}
