<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiporderItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiporder_itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->unsigned();
            $table->string('title');
            $table->string('note');
            $table->integer('quantity');
            $table->decimal('price',10,2);
            $table->timestamps();
            $table->softDeletes();
            //$table->foreign('order_id')->references('order_id')->on('shiporders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('shiporder_itens');
        Schema::enableForeignKeyConstraints();
    }
}
