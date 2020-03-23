<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    public function treatment() {
        return $this->belongsTo(Treatment::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

}
