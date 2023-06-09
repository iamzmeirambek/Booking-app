<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'city_id',
        'phone_number',
        'lat',
        'long'
    ];
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function reviews(): hasMany
    {
        return $this->hasMany(Review::class,'');
    }

    public function apartments(): hasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function fullAddress(): Attribute
    {
        return new Attribute(
            get:  fn() => $this->address
                . ', ' . $this->city->name
        );
    }
}
