<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
    public static function search(Request $req)
    {
        $query = self::getDetails();
        if($req->has('search')){
            $search = $req->get('search');
            $search = '%'.$search.'%';
            $query->where('episodes.title','LIKE',$search);
        }
        if($req->has('order')){
            $order = $req->get('order');
            $order = intval($order);
            if($order == 0){
                $query->orderBy('created_at','desc');
            }
            
        }
        return $query;
    }
}
