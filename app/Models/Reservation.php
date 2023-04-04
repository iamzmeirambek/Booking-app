<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'reservations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hotel_id',
        'room_id',
        'user_id',
        'guestFirstName',
        'guestlastName',
        'checkIn',
        'checkOut',
        'totalPrice',
    ];

    public function hotel(): belongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): belongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
