<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class UserRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'role'
    ];
    public static function search(Request $req)
    {
        $query = self::query('SELECT * FROM');
        if($req->has('search')){
            $search = $req->get('search');
            $search = '%'.$search.'%';
            // $search_user = User::where('name','LIKE','%'.$search.'%')->first();
            $query->where('role','LIKE',$search);
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

