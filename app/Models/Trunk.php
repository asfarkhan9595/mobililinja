<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trunk extends Model
{
    use HasFactory;
    protected $fillable = ['tname', 'description', 'secret', 'authentication', 'registration', 'sip_server', 'sip_secret_port', 'context', 'transport'];

}
