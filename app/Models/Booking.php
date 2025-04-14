<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'name',
        'email',
        'phone',
        'address',
        'document_type',
        'document_number',
        'check_in_date',
        'check_out_date',
        'no_of_nights',
        'expected_checkin_time',
        'no_of_adults',
        'no_of_children',
        'total_on_guest',
        'room_id',
        'company_name',
        'company_address',
        'company_website',
        'company_degignation',
        'subtotal',
        'discount',
        'tax_amount',
        'extra_charges',
        'advance_payment',
        'net_amount',
        'payment_status',
        'payment_method',
        'status',
        'special_requests',
        'purpose_of_visit',
        'document_verified',
    ];
    protected $casts = [
        'check_in_date' => 'date:H:i',
        'check_out_date' => 'date:H:i',
        'expected_checkin_time' => 'datetime:H:i',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'extra_charges' => 'decimal:2',
        'advance_payment' => 'decimal:2',
        'net_amount' => 'decimal:2',
    ];
    //relationship to room models
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function documents()
{
    return $this->hasMany(document::class);
}

const DOCUMENT_TYPES = [
    'passport' => 'Passport',
    'aadhar_card' => 'Aadhar Card',
    'driver_license' => 'Driver License',
    'voter_id' => 'Voter id',
    'pan_card' => 'Pan Card',
    'other' => 'Other'
];
   // Automatically generate booking ID when creating a new booking
   protected static function boot()
   {
       parent::boot();

       static::creating(function ($booking) {
           if (empty($booking->booking_id)) {
               $booking->booking_id = 'BK-' . strtoupper(uniqid());
           }
       });
   }
}
