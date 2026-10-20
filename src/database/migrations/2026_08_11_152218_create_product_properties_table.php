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
        Schema::create('product_properties', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('property_id');
            // group_id и is_multiple — копии из properties и property_groups.
            // Составные внешние ключи ниже не дают им разойтись с оригиналом
            $table->unsignedBigInteger('group_id');
            $table->boolean('is_multiple');
            $table->timestamps();

            $table->unique(['product_id', 'property_id']);

            // Значение должно принадлежать именно той группе, что указана в group_id
            $table->foreign(['property_id', 'group_id'])
                ->references(['id', 'group_id'])->on('properties')
                ->cascadeOnDelete();
            // Флаг должен совпадать с флагом группы; смена флага в группе каскадом обновится здесь
            $table->foreign(['group_id', 'is_multiple'])
                ->references(['id', 'is_multiple'])->on('property_groups')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });

        // Одиночная группа (is_multiple = false): не больше одного значения на товар.
        // Для групп с тегами ограничения нет. Частичный индекс — только Postgres-фича, в Blueprint её нет
        DB::statement(
            'CREATE UNIQUE INDEX product_properties_single_value
             ON product_properties (product_id, group_id) WHERE NOT is_multiple'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_properties');
    }
};
