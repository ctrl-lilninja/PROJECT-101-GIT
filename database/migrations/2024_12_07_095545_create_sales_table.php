<?php

// database/migrations/xxxx_xx_xx_create_sales_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_name');
            $table->string('contact');
            $table->string('address');
            $table->decimal('total_amount', 10, 2);  // Total amount for the sale
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}

