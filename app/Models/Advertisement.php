<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'image_url', 'target_url'
    ];

    public static function search(Request $req)
    {
        $query = self::query('SELECT * FROM');
        if($req->has('search')){
            $search = $req->get('search');
            $search = '%'.$search.'%';
            $query->where('title','LIKE',$search);
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
