<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
