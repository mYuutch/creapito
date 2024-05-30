<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'image_url',
        'type_id',
        'theme_id',
    ];


    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }


    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function theme(){
        return $this->belongsTo(Theme::class);
    }

    public function scopeNew(Builder $query, $quantity = 3)
    {
        return $query->latest()->limit($quantity);
    }
}


