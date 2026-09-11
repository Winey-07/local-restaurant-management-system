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
            $table->string("Cambodia_Food");
            $table->string("Rice");
            $table->string("Drink");
            $table->string("Desserts");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function(Blueprint $table){
            $table->dropColumn('Cambodia_Food');
            $table->dropColumn('Rice');
            $table->dropColumn('Drink');
            $table->dropColumn('Desserts');
        });
    }
};
