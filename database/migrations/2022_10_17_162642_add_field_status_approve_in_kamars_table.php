<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusApproveInKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->boolean('status')->default(0)->after('bg_foto');
            $table->text('desc_rooms')->nullable()->after('status');
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
