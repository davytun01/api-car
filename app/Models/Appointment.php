<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'requested_date',
        'message',
        'status',
        'car_id',
    ];

    protected $casts = [
        'requested_date' => 'datetime',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
