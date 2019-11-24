<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'sku',
        'order_number',
        'status',
        'total',
        'items',
        'payment_status',
        'first_name',
        'last_name',
        'address',
        'city',
        'country',
        'post_code',
        'phone_number',
        'note',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }

}
