<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
