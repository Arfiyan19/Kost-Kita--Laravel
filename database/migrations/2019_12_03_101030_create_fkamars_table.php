<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFkamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fkamars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('kamar_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('kamar_id')->references('id')->on('kamars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fkamars');
    }
}
