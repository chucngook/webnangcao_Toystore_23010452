<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up(): void
{
   Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Ai đã đặt hàng, nullable nếu là khách
    $table->string('customer_name');
    $table->string('customer_email');
    $table->string('customer_phone');
    $table->text('customer_address');
    $table->decimal('total_amount', 15, 2);
    $table->text('notes')->nullable();
    $table->string('status')->default('pending'); // pending, processing, completed, cancelled
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
