<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_photo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //foreign key
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('photo_id')->nullable();

            $table->unique(array('category_id', 'photo_id'));

            //foreign key properties
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_photo');
    }
}
