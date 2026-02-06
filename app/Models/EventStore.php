<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\EventStoreStatus;

class EventStore extends Model
{
    protected $table = 'event_stores';
use HasFactory;
    protected $fillable = [
        'event_id',
        'store_id',
        'status'
    ];

    protected $casts = [
        'status' => EventStoreStatus::class,
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}