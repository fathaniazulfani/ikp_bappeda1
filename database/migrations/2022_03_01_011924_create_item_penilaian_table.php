<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_penilaian', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_ikp')->unsigned(); // FK 
            $table->bigInteger('id_subdimensi')->unsigned(); // FK 
            $table->string('nama_item');
            $table->integer('nilai_item');
            $table->timestamps();
        });

        Schema::table('item_penilaian', function (Blueprint $table) {
            $table->foreign('id_ikp')->references('id')->on('ikp')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_subdimensi')->references('id')->on('subdimensi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_penilaian');
    }
}
