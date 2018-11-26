<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->unsignedInteger('incidence_type_id');
            $table->foreign('incidence_type_id')->references('id')->on('incidence_types');
            $table->unsignedInteger('requeriment_company_id');
            $table->foreign('requeriment_company_id')->references('id')->on('requeriment_companies');
            $table->unsignedInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')->onCascade('delete');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidences');
    }
}
