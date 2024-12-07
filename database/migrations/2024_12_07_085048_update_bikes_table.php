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
        $table->string('barcode')->nullable()->change(); // Change the column type to string
    });
}

public function down()
{
    Schema::table('bikes', function (Blueprint $table) {
        $table->dropColumn('barcode'); // Rollback if needed
    });
}

};
