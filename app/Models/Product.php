<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['store_id', 'name', 'unit_price', 'quantity', 'status'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
