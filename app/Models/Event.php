<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected function casts()
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function nfcTags()
    {
        return $this->hasMany(NfcTag::class);
    }
    public function eventStores()
    {
        return $this->hasMany(EventStore::class);
    }

    public function stores()
    {
        return $this->hasManyThrough(Store::class, EventStore::class);
    }

    public function isLive()
    {
        if (!$this->is_active) {
        return false;
    }

  
    return true;
    }

    public function isFinished(): bool
    {
        return now()->greaterThan($this->end_date);
    }
    
    public function isUpcoming(): bool
    {
        return now()->lessThan($this->start_date);
    }
}