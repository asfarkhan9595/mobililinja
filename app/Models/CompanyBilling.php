<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'card_number',
        'expiration_month',
        'expiration_year',
        'cvv',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
