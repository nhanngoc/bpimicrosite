<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('sex',50)->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('age_range')->nullable();
            $table->string('email')->unique();
            $table->string('contact_number', 15)->nullable();
            $table->string('province')->nullable();
            $table->string('redemption_code',50)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
