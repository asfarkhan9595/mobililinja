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
        Schema::create('customer_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('pbx')->nullable();
            $table->string('extensions')->nullable();
            $table->string('ivr')->nullable();
            $table->string('voicemail')->nullable();
            $table->string('ring_groups')->nullable();
            $table->string('conferences')->nullable();
            $table->string('call_recording')->nullable();
            $table->string('callback')->nullable();
            $table->string('calendar')->nullable();
            $table->string('reports')->nullable();
            $table->string('dashboard')->nullable();
            $table->string('speech_to_text')->nullable();
            $table->string('ai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_features');
    }
};
