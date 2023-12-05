<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function scopeGetDetails()
    {
        return $this->join('users', 'comments.user_id', '=', 'users.id')
                    ->join('movies', 'comments.movie_id', '=', 'movies.id')
                    ->select('comments.*', 'users.name as user', 'movies.title as movie');
    }
}
