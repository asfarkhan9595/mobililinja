<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('firewall_networks', function (Blueprint $table) {
            $table->id();
            $table->string('network_host');
            $table->string('assigned_zone');
            $table->string('customer_id');
            $table->string('description')->nullable();
            $table->date('accepted_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firewall_networks');
    }
};
