<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Space extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title', 'district_id', 'longitude', 'latitude', 'description',
        'address', 'phone', 'email', 'website', 'how_to_get'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
