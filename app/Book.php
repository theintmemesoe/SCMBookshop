<?php

namespace App;

use App\Author;
use App\Genre;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'price', 'author_id', 'genre_id', 'image', 'sample_pdf', 'published_date', 'description', 'create_user_id', 'updated_user_id', 'deleted_user_id', 'deleted_at',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
