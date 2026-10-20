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
        Schema::create('orders_products', function (Blueprint $table) {
            // Заказы не удаляются (отменяются статусом), поэтому физическое удаление заказа с позициями запрещено
            $table->foreignId('order_id')->constrained('orders')->restrictOnDelete();
            // Товар, который есть в заказах, физически удалить нельзя — только мягко (deleted_at)
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete();
            // Копия названия на момент заказа: переименование товара не меняет старые заказы
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->unique(['order_id', 'product_id']);
            // Проверка RESTRICT при удалении товара и запрос «в каких заказах товар»; unique выше начинается с order_id
            $table->index('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_products');
    }
};
