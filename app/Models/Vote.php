<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    public function scopeGetDetails()
    {
        return $this->join('users', 'votes.user_id', '=', 'users.id')
                    ->join('movies', 'votes.movie_id', '=', 'movies.id')
                    ->select('votes.*', 'users.name as user', 'movies.title as movie');
    }
}
