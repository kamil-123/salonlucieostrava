<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    // CAUTION!!!!
    protected $guarded = [];

    public function treatment() {
        return $this->belongsTo(Treatment::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function stylist() {
        return $this->belongsTo(Stylist::class);
    }

}
