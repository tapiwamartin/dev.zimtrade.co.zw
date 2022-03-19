<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->longText('description');
            $table->bigInteger('userId')->unsigned();
            $table->bigInteger('sectorId')->unsigned();
            $table->bigInteger('statusId')->unsigned()->default(1);
            $table->bigInteger('agentId')->unsigned();
            $table->integer('slaId')->nullable();
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sectorId')->references('id')->on('sectors')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
