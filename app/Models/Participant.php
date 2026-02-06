<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Participant extends Model
{
   protected $fillable = ['user_id', 'nfc_tag_id', 'balance','event_id'];
use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nfcTag()
    {
        return $this->belongsTo(NfcTag::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function event()
{
    return $this->belongsTo(Event::class);
}
}
