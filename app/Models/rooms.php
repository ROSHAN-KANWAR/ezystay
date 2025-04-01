<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
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
    public static function getAvailableRooms($type)
{
    return self::where('type', $type)
              ->where('status', 'available')
              ->get(['id', 'room_no', 'price']);
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