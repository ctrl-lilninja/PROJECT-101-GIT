<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Bike name
            $table->string('model'); // Bike model
            $table->unsignedBigInteger('category_id'); // Foreign key to categories
            $table->integer('quantity'); // Quantity of bikes
            $table->double('price', 10, 2); // Bike price
            $table->string('barcode')->nullable(); // Barcode (nullable)
            $table->string('photo')->nullable(); // Bike photo path (nullable)
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bikes');
    }
}