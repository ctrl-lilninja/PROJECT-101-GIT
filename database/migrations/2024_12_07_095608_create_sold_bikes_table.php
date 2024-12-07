<?php
// database/migrations/xxxx_xx_xx_create_sold_bikes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldBikesTable extends Migration
{
    public function up()
    {
        Schema::create('sold_bikes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');  // Foreign key to `sales`
            $table->foreignId('bike_id')->constrained('bikes')->onDelete('cascade');  // Foreign key to `bikes`
            $table->integer('quantity');  // Quantity of bikes bought
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sold_bikes');
    }
}

