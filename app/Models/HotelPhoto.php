<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelPhoto extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'hotel_photos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'path'
    ];

    public function hotel(): belongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
