<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturalar', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('musteriAdSoyad');
            $table->string('faturaNo');
            $table->integer('yuzdelikKar')->default(0);
            $table->integer('iscilik')->default(0);
            $table->integer('yol')->default(0);
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
        Schema::dropIfExists('faturalar');
    }
};
