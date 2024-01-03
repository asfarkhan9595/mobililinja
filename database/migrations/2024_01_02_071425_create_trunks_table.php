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
        Schema::create('trunks', function (Blueprint $table) {
            $table->id();
            $table->string('tname');
            $table->text('description')->nullable();
            $table->string('secret');
            $table->string('authentication');
            $table->string('registration');
            $table->string('sip_server');
            $table->integer('sip_secret_port');
            $table->string('context');
            $table->string('transport');
            // Add other columns if needed

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trunks');
    }
};
