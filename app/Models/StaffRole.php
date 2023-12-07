<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'role'
    ];
    public function staffs(){
        return $this->hasMany(Staff::class,'staff_roles','id');
    }
}
