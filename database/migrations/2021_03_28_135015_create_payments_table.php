<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kamar_id');
            $table->enum('type_transfer',['Bank','E-Wallet'])->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->enum('status',['Pending','Success','Cancel'])->default('Pending');
            $table->enum('bank_tujuan',['BNI','BRI','BCA','MANDIRI'])->nullable();
            $table->integer('jumlah_bayar')->nullable();
            $table->string('tgl_transfer')->nullable(); //Image
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kamar_id')->references('id')->on('kamars')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
