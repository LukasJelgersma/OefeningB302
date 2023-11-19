<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory;
    /**
     * The books that belong to the genre
     */
    protected $fillable =[
        'genre_id',
        'name',
        'createdAt',
        'updatedAt'
    ];
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
