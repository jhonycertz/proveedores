<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeCompanyRequerimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_type_requeriment', function (Blueprint $table) {

            $table->unsignedInteger('requeriment_id');
            $table->foreign('requeriment_id')->references('id')->on('requeriments');

            $table->unsignedInteger('company_type_id');
            $table->foreign('company_type_id')->references('id')->on('company_types');

            $table->primary(['requeriment_id', 'company_type_id']); 
        });
    }

    /** 4boot_test.
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_type_requeriment');
    }
}
