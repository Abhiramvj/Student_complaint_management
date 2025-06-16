<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }


}
