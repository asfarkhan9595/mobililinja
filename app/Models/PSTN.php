<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PSTN extends Model
{
    use HasFactory;

    protected $table = 'pstn';

    protected $fillable = [
        'provider',
        'number_pool',
        'customer_id'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
