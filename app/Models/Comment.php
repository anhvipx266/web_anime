<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','movie_id','content'
    ];
    public function scopeGetDetails()
    {
        return $this->join('users', 'comments.user_id', '=', 'users.id')
                    ->join('movies', 'comments.movie_id', '=', 'movies.id')
                    ->select('comments.*', 'users.name as user', 'movies.title as movie');
    }
    public static function search(Request $req)
    {
        $query = self::GetDetails();
        if($req->has('search')){
            $search = $req->get('search');
            $search = '%'.$search.'%';
            $query->where('content','LIKE',$search);
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
