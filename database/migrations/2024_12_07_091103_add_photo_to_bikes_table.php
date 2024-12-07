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
        $table->string('photo')->nullable(); // Add a nullable string column for photo filename
    });
}

public function down()
{
    Schema::table('bikes', function (Blueprint $table) {
        $table->dropColumn('photo'); // Drop the photo column if migration is rolled back
    });
}

};
