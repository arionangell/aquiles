<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockdays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_producto');
            $table->integer('id_empresa');
            $table->float('cantidad');
            $table->date('stock_date');
            $table->integer('estado')->default(0);
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
        Schema::dropIfExists('stockdays');
    }
}
