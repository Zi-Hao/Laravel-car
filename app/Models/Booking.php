<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $table='bookings';

    public $primarkey='id';

    protected $fillable = [
        'id',
        'name',
        'subject',
        'booking_time',
        'coach',
        'complete',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*public function getBooking()
    {
        return "{$this->name}{$this->coach}{$this->subject}{$this->booking_time}";
    }*/
}
