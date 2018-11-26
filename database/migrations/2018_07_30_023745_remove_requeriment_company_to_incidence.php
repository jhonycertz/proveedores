<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveRequerimentCompanyToIncidence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidences', function (Blueprint $table) {
            $table->dropForeign(['requeriment_company_id']);
            $table->dropColumn('requeriment_company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidences', function (Blueprint $table) {
            //
        });
    }
}
