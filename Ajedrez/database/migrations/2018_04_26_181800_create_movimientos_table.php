<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ultpos1')->default(3);
            $table->integer('ultname1')->default(0);
            $table->string('ultficha1')->default("t4");
            $table->integer('ultpos2')->default(59);
            $table->integer('ultname2')->default(1);
            $table->string('ultficha2')->default("t60");
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
        Schema::dropIfExists('movimientos');
    }
}
