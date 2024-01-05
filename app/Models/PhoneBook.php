<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model
{
    use HasFactory;
    protected $table = 'phone_books';
    protected $fillable = [
    
        'first_name',
        'last_name',
        'phone_number' ,
        'mobile_number',
        'company' ,
        'position',
    ];
}
