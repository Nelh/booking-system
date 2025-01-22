<?php

namespace Nel\BookingSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "booking_services";

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
