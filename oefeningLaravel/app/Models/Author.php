<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
}
