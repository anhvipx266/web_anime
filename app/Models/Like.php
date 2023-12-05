<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public function scopeGetDetails()
    {
        return $this->join('users', 'likes.user_id', '=', 'users.id')
                    ->join('movies', 'likes.movie_id', '=', 'movies.id')
                    ->select('likes.*', 'users.name as user', 'movies.title as movie');
    }
}
