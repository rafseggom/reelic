<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            //$table->text('comment')->nullable();
            $table->bigInteger('rating')->nullable();
            $table->timestamps();

            //foreign key
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->unique(array('user_id', 'photo_id'));

            //foreign key properties
            $table->foreign('photo_id')->references('id')->on('photos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
