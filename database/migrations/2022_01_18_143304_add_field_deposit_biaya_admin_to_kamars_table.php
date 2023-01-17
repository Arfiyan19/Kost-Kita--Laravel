<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDepositBiayaAdminToKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kamars', function (Blueprint $table) {
          $table->integer('deposit')->after('harga_kamar');
          $table->integer('biaya_admin')->after('deposit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kamars', function (Blueprint $table) {
            //
        });
    }
}
