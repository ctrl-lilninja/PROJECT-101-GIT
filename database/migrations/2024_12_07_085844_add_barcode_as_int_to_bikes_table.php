<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('bikes', function (Blueprint $table) {
        $table->bigInteger('barcode')->nullable(); // Use bigInteger for barcode (or integer if you prefer)
    });
}

public function down()
{
    Schema::table('bikes', function (Blueprint $table) {
        $table->dropColumn('barcode');
    });
}

};
