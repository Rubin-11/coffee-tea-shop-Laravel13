<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            // Удалили группу — удалились её значения
            $table->foreignId('group_id')->constrained('property_groups')->cascadeOnDelete();
            // И текст («Сухая»), и число шкалы («7») — строкой; порядок вывода задаёт sort
            $table->string('value');
            $table->unsignedSmallInteger('sort')->default(0);
            $table->timestamps();

            $table->unique(['group_id', 'value']);
            // Нужен как цель составного внешнего ключа из product_properties (property_id, group_id)
            $table->unique(['id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
