<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Store extends Model
{
    protected $fillable = ['user_id', 'name', 'logo', 'status'];
use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function eventStores()
    {
        return $this->hasMany(EventStore::class);
    }

    public function events()
    {
        return $this->hasManyThrough(Event::class, EventStore::class);
    }
}
