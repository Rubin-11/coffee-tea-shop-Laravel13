<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Корзина только авторизованных пользователей. Корзина гостя живёт в сессии
        // и переносится сюда при входе (этап 6)
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            // Один товар — одна строка в корзине пользователя: повторное добавление увеличивает quantity
            $table->unique(['user_id', 'product_id']);
            // Postgres не индексирует внешний ключ сам; нужен для удаления товара и поиска корзин с ним
            $table->index('product_id');
            $table->timestamps();
        });

        // В Postgres нет unsigned-типов (unsignedInteger() молча станет integer),
        // поэтому запрет нулевого и отрицательного количества — через CHECK
        DB::statement('ALTER TABLE baskets ADD CONSTRAINT baskets_quantity_positive CHECK (quantity > 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};
