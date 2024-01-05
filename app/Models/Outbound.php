<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbound extends Model
{
    use HasFactory;

    protected $table = 'outbounds';
    protected $fillable = [
        'prepend',
        'prefix',
        'match_pattern',
        'trunk_id'
    ];

    public function trunk()
    {
       
        return $this->belongsTo(Trunk::class, 'trunk_id');
    }
}
