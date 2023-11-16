<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable =[
        'book_id',
        'name',
        'author_id',
        'createdAt',
        'updatedAt'
    ];

    /**
     * The genres that belong to the books
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
