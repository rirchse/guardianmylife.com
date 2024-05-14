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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->time('call_time');            
            $table->integer('user')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('agent')->nullable();            
            $table->string('contact')->nullable();
            $table->text('notes')->nullable();
            $table->string('number_notes')->nullable();
            $table->string('appointment')->nullable();
            $table->dateTime('appointment_time')->nullable();
            $table->text('appointment_location')->nullable();
            $table->text('appointment_notes')->nullable();
            $table->string('meet')->nullable();
            $table->string('sold')->nullable();
            $table->integer('premium')->nullable();
            $table->integer('product')->nullable();
            $table->float('commission')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
