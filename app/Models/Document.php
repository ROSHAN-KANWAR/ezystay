<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'document_type',
        'file_path',
        'side',
        'guest_name'
    ];

    /**
     * The possible document types.
     */
    const DOCUMENT_TYPES = [
        'passport' => 'Passport',
        'id_card' => 'ID Card',
        'driver_license' => 'Driver License',
        'visa' => 'Visa',
        'other' => 'Other'
    ];

    /**
     * The possible document sides.
     */
    const SIDES = [
        'front' => 'Front',
        'back' => 'Back'
    ];

    /**
     * Get the booking that owns the document.
     */
  
    /**
     * Get the human-readable document type.
     */
    public function getDocumentTypeNameAttribute()
    {
        return self::DOCUMENT_TYPES[$this->document_type] ?? $this->document_type;
    }

    /**
     * Get the human-readable side name.
     */
    public function getSideNameAttribute()
    {
        return self::SIDES[$this->side] ?? $this->side;
    }

    /**
     * Get the full storage path to the document.
     */
    public function getFullPathAttribute()
    {
        return storage_path('app/' . $this->file_path);
    }

    /**
     * Get the public URL for the document (if stored in public disk).
     */
    public function getPublicUrlAttribute()
    {
        return asset('storage/' . str_replace('public/', '', $this->file_path));
    }
    
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
