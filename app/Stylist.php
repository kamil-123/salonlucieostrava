<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    protected $table = 'stylists';

    public function user() {
        return $this->hasOne(User::class);
    }

    public function treatments() {
        return $this->hasMany(Treatment::class);
    }

    public function booking() {
        return $this->hasMany(Booking::class);
    }

}
