<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStartDateAndEndDateToPromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promos', function (Blueprint $table) {
          $table->string('start_date_promo')->after('keterangan')->nullable();
          $table->string('end_date_promo')->after('start_date_promo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promos', function (Blueprint $table) {
            //
        });
    }
}
