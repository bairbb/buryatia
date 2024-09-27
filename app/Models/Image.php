<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['space_id', 'path', 'alt'];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
