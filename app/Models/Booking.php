<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_id',
        'name',
        'email',
        'phone',
        'address',
        'document_type',
        'document_number',
        'room_id',
        'check_in_date',
        'check_out_date',
        'no_of_nights',
        'subtotal',
        'payment_status',
        'payment_mode',
        'discount',
        'advance_payment',
        'net_amount',
        'special_requests',
        'status'

    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) { 
            // Ensure check_out_date is after check_in_date
            if ($booking->check_out_date <= $booking->check_in_date) {
                throw new \Exception("Check-out date must be after check-in date");
            }
            
            // Calculate no_of_nights if not provided
            if (empty($booking->no_of_nights)) {
                $booking->no_of_nights = $booking->check_in_date->diffInDays($booking->check_out_date);
            }
        });
    }

    

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }

}