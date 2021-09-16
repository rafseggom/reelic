<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->unique();
            $table->timestamps();

            //foreign key
           // $table->unsignedBigInteger('photo_id')->nullable();
           // $table->unsignedBigInteger('user_id')->nullable();


            //foreign key properties
          //  $table->foreign('photo_id')->references('id')->on('photos')->onUpdate('cascade')->onDelete('set null');
          //  $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
