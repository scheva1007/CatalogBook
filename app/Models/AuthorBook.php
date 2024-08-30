<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function book()
    {
        return $this->belongsToMany(Book::class);
    }

    public function author()
    {
        return $this->belongsToMany(Author::class);
    }
}
