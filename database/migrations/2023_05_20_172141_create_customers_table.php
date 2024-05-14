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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();          
           $table->integer('leads_id')->nullable();
           $table->integer('current_status')->nullable()->comment('1 Lead\r\n2 Prospect\r\n3 Customer');
           $table->integer('assigned_to')->nullable();
           $table->integer('Lead_ID')->nullable();
           $table->date('Lead_Date')->nullable();
           $table->string('First_Name')->nullable();
           $table->string('Last_Name')->nullable();
           $table->string('Status')->nullable();
           $table->string('Lead_Type')->nullable();
           $table->string('Lead_Owner')->nullable();
           $table->date('Date_of_Birth')->nullable();
           $table->string('Age')->nullable();
           $table->string('Email')->nullable();
           $table->string('Home')->nullable();
           $table->string('Mobile')->nullable();
           $table->string('Work')->nullable();
           $table->string('Other_Phone_1')->nullable();
           $table->string('Other_Phone_2')->nullable();
           $table->string('Mortgage_Amt')->nullable();
           $table->string('Mortgage_Date')->nullable();
           $table->string('Lendor')->nullable();
           $table->datetime('Last_Modified')->nullable();
           $table->string('Street_Address')->nullable();
           $table->string('City')->nullable();
           $table->string('State')->nullable();
           $table->string('Zip')->nullable();
           $table->string('County')->nullable();
           $table->string('Notes')->nullable();
           $table->string('Assets_Notes')->nullable();
           $table->string('policy_number')->nullable();
           $table->string('company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
