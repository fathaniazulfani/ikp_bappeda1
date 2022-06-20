<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_ikp')->unsigned(); // FK - (id) ikp
            $table->string('nama_dimensi');
            $table->integer('nilai_dimensi');
            $table->timestamps();
        });

        Schema::table('dimensi', function (Blueprint $table) {
            $table->foreign('id_ikp')->references('id')->on('ikp')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dimensi');
    }
}
