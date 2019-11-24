<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'image',
        'description',
        'stock',
        'price',
        'sale_price',
        'status',
        'featured',
        'user_id',
    ];

    protected $casts = [
        'stock' => 'integer',
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
