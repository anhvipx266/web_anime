<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','country_id','series_id','author_id','description','thumbnail',
        'release_date','vote_count','like_count','view_count'
    ];
}
