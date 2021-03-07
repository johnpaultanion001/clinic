<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->string('address')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
