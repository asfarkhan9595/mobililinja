<?php

namespace App\Models;

use Cassandra\Custom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirewallNetwork extends Model
{
    use HasFactory;
    protected $fillable = [
        "network_host",
        "assigned_zone",
        "customer_id",
        "description",
        "accepted_date"
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
