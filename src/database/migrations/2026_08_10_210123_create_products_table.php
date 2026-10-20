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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Категорию с товарами (в том числе мягко удалёнными) удалить нельзя — сначала перенести товары
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->integer('reviews_count')->default(0);
            $table->index('category_id');
            $table->timestamps();
            // deleted_at: мягкое удаление — товар скрыт с витрины, но строка остаётся для истории заказов
            $table->softDeletes();
        });

        // В Postgres нет unsigned-типов, поэтому остаток и счётчик отзывов не могут уйти в минус только через CHECK
        DB::statement('ALTER TABLE products ADD CONSTRAINT products_quantity_non_negative CHECK (quantity >= 0)');
        DB::statement('ALTER TABLE products ADD CONSTRAINT products_reviews_count_non_negative CHECK (reviews_count >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
