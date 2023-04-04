<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'reviews';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hotel_id',
        'full_name',
        'comment',
        'limitations',
        'rating',
    ];

    public function hotel(): belongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
