<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_number',
        'company_name',
        'street_address',
        'zip',
        'city',
        'country',
        'vat',
        'contact_person_name',
        'contact_person_email',
        'contact_person_phone',
    ];

    public function features()
    {
        return $this->hasOne(CompanyFeatures::class);
    }

    public function billing()
    {
        return $this->hasOne(CompanyBilling::class);
    }
}
