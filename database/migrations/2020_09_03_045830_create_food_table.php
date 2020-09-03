<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            // $table->user();
            $table->string('food_item');
            $table->double('food_price', 5, 2);
            $table->string('food_quantity');
            $table->timestamps();
        });
        
        Schema::create('foodcart', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('food_id')->references('id')->on('food')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->string('food_item');
            // $table->double('food_price', 5, 2);
            // $table->string('food_quantity');
            $table->timestamp('created_at')->useCurrent(time());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
        Schema::dropIfExists('fooduser');
    }
}
