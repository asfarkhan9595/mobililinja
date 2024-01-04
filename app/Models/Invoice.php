<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number','date','amount','status','payment_mode','customer_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
