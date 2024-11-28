<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Space extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;

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

    public function searchableAs(): string
    {
        return 'space_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
