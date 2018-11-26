<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('identity',50);
            $table->string('address',300);
            $table->string('phone',30);
            $table->string('email',50);
            $table->string('catalogo_path',120);
            $table->unsignedInteger('company_type_id');
            $table->foreign('company_type_id')->references('id')->on('company_types');
            $table->enum('status',['ESPERA','EN-PROCESO','APROBADA','RECHAZADA'])->default('ESPERA');
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
        Schema::dropIfExists('companies');
    }
}
