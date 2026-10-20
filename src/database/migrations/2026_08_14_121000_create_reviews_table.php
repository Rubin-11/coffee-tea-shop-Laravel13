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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Отзывы пишут только авторизованные, поэтому user_id NOT NULL; удалили пользователя — ушли его отзывы
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // Срабатывает только при физическом удалении товара; мягко удалённый товар держит свои отзывы
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('body');
            $table->timestamps();

            // Один пользователь — один отзыв на товар
            $table->unique(['user_id', 'product_id']);
            // Список отзывов товара; unique выше начинается с user_id и для этого не подходит
            $table->index('product_id');
        });

        // Оценка от 1 до 5. unsigned в Postgres нет (tinyInteger станет smallint), диапазон держит CHECK
        DB::statement('ALTER TABLE reviews ADD CONSTRAINT reviews_rating_range CHECK (rating BETWEEN 1 AND 5)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
