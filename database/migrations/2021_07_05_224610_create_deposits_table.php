<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->string('transactionDate');
            $table->bigInteger('userId')->unsigned();
            $table->bigInteger('regionId')->unsigned();
            $table->bigInteger('narrationId')->unsigned()->default(1);
            $table->bigInteger('currencyId')->unsigned();
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('regionId')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('narrationId')->references('id')->on('narrations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currencyId')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
