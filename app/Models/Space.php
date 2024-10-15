<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'district_id', 'longitude', 'latitude', 'description',
        'address', 'phone', 'email', 'website', 'how_to_get'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
