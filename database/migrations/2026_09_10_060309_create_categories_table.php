<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("ពេលព្រឹក");
            $table->string("ពេលថ្ងៃ");
            $table->string("ពេលល្ងាច");
            $table->string("ភេសជ្ជៈ");
            $table->string('ផ្សេងៗ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function(Blueprint $table){
            $table->dropColumn('ពេលព្រឹក');
            $table->dropColumn('ពេលថ្ងៃ');
            $table->dropColumn('ពេលល្ងាច');
            $table->dropColumn('ភេសជ្ជៈ');
            $table->dropColumn('ផ្សេងៗ');
        });
    }
};
