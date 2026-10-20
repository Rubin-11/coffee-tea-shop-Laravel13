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
        Schema::create('property_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            // Ключ группы для фильтров и кода: не зависит от русского названия
            $table->string('slug')->unique();
            // false — у товара ровно одно значение группы (обжарка), true — несколько (теги «Особые»)
            $table->boolean('is_multiple')->default(false);
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();

            // Нужен как цель составного внешнего ключа из product_properties (group_id, is_multiple)
            $table->unique(['id', 'is_multiple']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_groups');
    }
};
