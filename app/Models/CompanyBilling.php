<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBilling extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_full_name',
        'billing_card_number',
        'billing_expiration_month',
        'billing_expiration_year',
        'billing_cvv',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
