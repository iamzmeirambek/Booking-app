<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'hotel_rooms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hotel_id',
        'roomType',
        'capacity',
        'bedOption',
        'price',
        'view',
        'totalRooms',
    ];

    public function hotel(): belongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservation(): hasMany
    {
        return $this->hasMany(Reservation::class,'room_id','id');
    }

}
