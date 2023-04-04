<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'hotels';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'description',
        'city',
        'country',
        'telephoneNumber',
        'imagePath'
    ];

    public function reviews(): hasMany
    {
        return $this->hasMany(Review::class,'');
    }

    public function rooms(): hasMany
    {
        return $this->hasMany(Room::class,'');
    }
}
