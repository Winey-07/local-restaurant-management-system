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
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'Cambodia_Food')) {
                $table->dropColumn('Cambodia_Food');
            }
            if (Schema::hasColumn('categories', 'Rice')) {
                $table->dropColumn('Rice');
            }
            if (Schema::hasColumn('categories', 'Drink')) {
                $table->dropColumn('Drink');
            }
            if (Schema::hasColumn('categories', 'Desserts')) {
                $table->dropColumn('Desserts');
            }
            if (! Schema::hasColumn('categories', 'name')) {
                $table->string('name')->after('id');
            }
            if (! Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['name', 'description']);
        });
    }
};
