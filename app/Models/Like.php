<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Like extends Model
{
    use HasFactory;
    public function scopeGetDetails()
    {
        return $this->join('users', 'likes.user_id', '=', 'users.id')
                    ->join('movies', 'likes.movie_id', '=', 'movies.id')
                    ->select('likes.*', 'users.name as user', 'movies.title as movie');
    }
    public static function search(Request $req)
    {
        $query = self::getDetails();
        if($req->has('search')){
            $search = $req->get('search');
            $search = '%'.$search.'%';
            // $search_user = User::where('name','LIKE','%'.$search.'%')->first();
            $query->where('users.name','LIKE',$search);
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
