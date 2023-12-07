<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','movie_id','thumbnail'
    ];
    public function scopeGetDetails()
    {
        return $this->join('movies', 'episodes.movie_id', '=', 'movies.id')
                    ->select('episodes.*', 'movies.title as movie');
    }
}
