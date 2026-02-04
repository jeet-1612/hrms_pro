<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'title',
        'department_id',
        'description',
        'min_salary',
        'max_salary',
        'level',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
