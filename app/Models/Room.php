<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'room_no',
        'floor',
        'price',
        'type',
        'status',
        'description',
        'capacity'
    ];

    protected $casts = [
        'type' => 'string',
        'status' => 'string',
    ];

    // You can add these methods for better enum handling
    static public function getTypeOptions()
    {
        return [
            'single' => 'Single',
            'double' => 'Double',
            'suite' => 'Suite',
            'deluxe' => 'Deluxe'
        ];
    }


    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
    public function scopeOccupied($query)
    {
        return $query->where('status', 'occupied');
    }
   static public function getStatusOptions()
    {
        return [
            'available' => 'Available',
            'occupied' => 'Occupied',
            'maintenance' => 'Maintenance',
        ];
    }
   static public function getFloorOptions()
    {
        return range(1, 3); 
    }
}
