<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('outbounds', function (Blueprint $table) {
            $table->id();
            $table->string('prepend')->default('+');
            $table->string('prefix');
            $table->string('match_pattern');
            $table->foreignId('trunk_id')->constrained();
            $table->timestamps();

           
        });
    }

    public function down()
    {
        Schema::dropIfExists('outbounds');
    }
};
