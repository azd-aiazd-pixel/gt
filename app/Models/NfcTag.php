<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\NfcTagStatus;
class NfcTag extends Model
{
   protected $fillable = ['nfc_code', 'status', 'event_id'];
use HasFactory;
   public function participant()
    {
        return $this->hasOne(Participant::class);
    }

public function event()
{
    return $this->belongsTo(Event::class);
}




protected function casts(): array
    {
        return [
            'status' => NfcTagStatus::class,
        ];
    }
    
    
}
