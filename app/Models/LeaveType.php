<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Table name
     */
    protected $table = 'leave_types';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'default_days',
        'is_paid',
        'requires_approval',
        'carry_forward',
        'max_carry_forward',
        'applicable_to',
        'status',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'is_paid'            => 'boolean',
        'requires_approval'  => 'boolean',
        'carry_forward'      => 'boolean',
        'default_days'       => 'integer',
        'max_carry_forward'  => 'integer',
        'applicable_to'      => AsArrayObject::class,
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}