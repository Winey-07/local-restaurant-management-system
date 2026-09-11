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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('table_id')->constrained('restaurant_tables')->onDelete('cascade');
        $table->decimal('subtotal', 10, 2)->default(0.00);
        $table->decimal('total_discount', 10, 2)->default(0.00);
        $table->decimal('total_amount', 10, 2)->default(0.00);
        $table->enum('status', ['Pending', 'Preparing', 'Ready', 'Completed', 'Cancelled'])->default('Pending');
        $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
        $table->timestamps();
    });
}  
    // 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
