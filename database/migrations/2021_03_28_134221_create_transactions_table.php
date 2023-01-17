<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('transaction_number');
            $table->unsignedBigInteger('kamar_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('lama_sewa');
            $table->integer('harga_kamar');
            $table->integer('harga_total');
            $table->string('tgl_sewa');
            $table->enum('status',['Pending','Proses','Done','Cancel','Reject'])->default('Pending');
            $table->timestamps();

            $table->foreign('kamar_id')->references('id')->on('kamars');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
