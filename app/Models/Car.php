<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'price',
        'mileage',
        'fuel_type',
        'transmission',
        'color',
        'description',
        'status',
        'image_url',
    ];

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Query Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFilterByBrand($query, $brand)
    {
        if ($brand) {
            return $query->where('brand', 'like', "%{$brand}%");
        }
        return $query;
    }

    public function scopeFilterByPriceRange($query, $min, $max)
    {
        if ($min) {
            $query->where('price', '>=', $min);
        }
        if ($max) {
            $query->where('price', '<=', $max);
        }
        return $query;
    }
}
