<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('slug');
            $table->string('nama_kamar');
            $table->enum('jenis_kamar',['Putra','Putri','Campur']);
            $table->string('luas_kamar');
            $table->integer('stok_kamar');
            $table->integer('sisa_kamar');
            $table->integer('harga_kamar');
            $table->string('ket_lain')->nullable();
            $table->string('ket_biaya')->nullable();
            $table->string('desc')->nullable();
            $table->enum('kategori',['Kost','Apartment']);
            $table->enum('book',[0,1]); // 0 no
            $table->enum('listrik',[0,1]); // 0 no
            $table->string('province_id');
            $table->string('bg_foto');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamars');
    }
}
