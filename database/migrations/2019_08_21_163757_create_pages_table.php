<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('title_alias');
            $table->string('summary')->nullable()->default(null);
            $table->longText('content')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->longText('params');
            $table->tinyInteger('public', false, true)->default(1);
            $table->integer('hits', false, true)->default(0);
            $table->integer('category_id', false, true);
            $table->integer('created_by', false, true)->nullable()->default(null);
            $table->integer('updated_by', false, true)->nullable()->default(null);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pages');
        Schema::enableForeignKeyConstraints();
    }
}
