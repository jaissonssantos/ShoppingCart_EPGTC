<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';

    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
