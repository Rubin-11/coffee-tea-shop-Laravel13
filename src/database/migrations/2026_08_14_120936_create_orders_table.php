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
            // NULL — гостевой заказ или пользователь удалён: заказ при этом остаётся в истории
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('order_number')->unique();
            $table->decimal('price', 10, 2);
            // Допустимые значения — enum App\Enums\PaymentMethod (cast в модели), а не enum Postgres: добавить
            // способ оплаты не потребует миграции с пересозданием CHECK
            $table->string('payment_method', 20);

            // Контакты покупателя — копия на момент заказа, не зависит от users
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20);

            // Адрес доставки — копия на момент заказа, не зависит от user_addresses
            $table->string('country');
            $table->string('region');
            $table->string('city');
            $table->string('street');
            $table->string('house_number');
            $table->string('flat_number')->nullable(); // в частном доме квартиры нет

            // Допустимые значения — App\Enums\OrderStatus (cast в модели)
            $table->string('status', 20)->default('pending');
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
