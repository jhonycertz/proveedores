<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requeriments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',300);
            $table->string('code',20);
            $table->boolean('required')->default(true);
            $table->unsignedInteger('requeriment_type_id');
            $table->foreign('requeriment_type_id')->references('id')->on('requeriment_types')->onCascade('delete');
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
        Schema::dropIfExists('requeriments');
    }
}
