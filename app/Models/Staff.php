<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
class Staff extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'address',
        'avatar',
        'staff_roles'
    ];
    public function scopeGetDetails()
    {
        return $this->join('staff_roles', 'staff.staff_roles', '=', 'staff_roles.id')
                    ->select('staff.*', 'staff_roles.role as role');
    }
    public function role(){
        return $this->belongsTo(StaffRole::class,'staff_roles','id');
    }
    public static function search(Request $req)
    {
        $query = self::getDetails();
        if($req->has('search')){
            $search = $req->get('search');
            $search = '%'.$search.'%';
            // $search_user = User::where('name','LIKE','%'.$search.'%')->first();
            $query->where('name','LIKE',$search);
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
