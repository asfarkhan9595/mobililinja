<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'error_message',
        'user_id',
        'module',
        'ip_address',
        'file',
        'line',
        'request_method',
        'request_uri',
        'request_params',
        'session_id',
        'session_data',
        'user_agent',
        'exception_type',
        'stack_trace',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
