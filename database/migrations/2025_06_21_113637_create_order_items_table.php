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
   Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Thuộc đơn hàng nào
    $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null'); // Sản phẩm nào
    $table->string('product_name'); // Lưu lại tên SP phòng khi SP gốc bị xóa
    $table->integer('quantity');
    $table->decimal('price', 15, 2); // Lưu lại giá tại thời điểm mua
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
        Schema::dropIfExists('order_items');
    }
};
