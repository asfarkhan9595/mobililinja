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
        Schema::create('application_logs', function (Blueprint $table) {
            $table->id();
            $table->text('error_message');
            $table->string('user_id')->nullable();
            $table->string('module')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('file')->nullable();
            $table->integer('line')->nullable();
            $table->string('request_method')->nullable();
            $table->text('request_uri')->nullable();
            $table->text('request_params')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_logs');
    }
};
