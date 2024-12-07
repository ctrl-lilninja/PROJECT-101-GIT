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
        $table->dropColumn('barcode');
    });
}

public function down()
{
    Schema::table('bikes', function (Blueprint $table) {
        $table->string('barcode')->nullable(); // Add it back as a string if you want to revert this
    });
}

};
