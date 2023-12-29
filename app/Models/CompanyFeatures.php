<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyFeatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'pbx',
        'extensions',
        'ivr',
        'voicemail',
        'ring_groups',
        'conferences',
        'call_recording',
        'callback',
        'calendar',
        'reports',
        'dashboard',
        'speech_to_text',
        'ai',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
