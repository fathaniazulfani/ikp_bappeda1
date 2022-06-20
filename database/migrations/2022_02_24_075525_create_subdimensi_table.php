<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdimensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subdimensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_dimensi')->unsigned(); // FK - (id) dimensi
            $table->string('nama_sub');
            $table->integer('nilai_sub');
            $table->timestamps();
        });

        Schema::table('subdimensi', function (Blueprint $table) {
            $table->foreign('id_dimensi')->references('id')->on('dimensi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subdimensi');
    }
}
