<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('min_provider_price');
            $table->unsignedBigInteger('max_provider_price');
            $table->string('name');
            $table->boolean('is_enabled');
            $table->unsignedBigInteger('min_quantity');
            $table->unsignedBigInteger('max_quantity');
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
        Schema::dropIfExists('services');
    }
}
