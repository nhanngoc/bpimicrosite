<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned()->references('id')->on('users')->index();
            $table->string('module', 60)->index();
            $table->text('request')->nullable();
            $table->string('action', 120);
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 25)->nullable();
            $table->integer('reference_user')->unsigned();
            $table->integer('reference_id')->unsigned();
            $table->string('reference_name', 255);
            $table->string('type', 20);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_histories');
    }
}
