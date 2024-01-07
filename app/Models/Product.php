<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $casts = [
        'price' => 'decimal:2'
    ];

    protected $with = ['images'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
