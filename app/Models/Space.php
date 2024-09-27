<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = ['district_id', 'title', 'slug', 'description', 'address', 'phone', 'email', 'website', 'latitude', 'longitude', 'how_to_get'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
