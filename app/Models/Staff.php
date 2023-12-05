<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];
    public function scopeGetDetails()
    {
        return $this->join('staff_roles', 'staff.staff_roles', '=', 'staff_roles.id')
                    ->select('staff.*', 'staff_roles.role as role');
    }
}
