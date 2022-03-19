<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('newsletterId');
            $table->string('path');
            $table->timestamps();
            $table->foreign('newsletterId')->references('id')->on('newsletters')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsletter_files');
    }
}
