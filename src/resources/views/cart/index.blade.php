@extends('layouts.main-layout')

@section('title', 'Корзина')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <h1 class="text-4xl font-bold text-gray-900 mb-8">Корзина</h1>

        {{-- Основной контент корзины --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Список товаров --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- Товар 1 --}}
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 flex items-center gap-4">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Эфиопский Иргачеф</h3>
                        <p class="text-sm text-gray-500 mb-3">Свежеобжаренный кофе</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <button class="w-8 h-8 border border-gray-300 rounded flex items-center justify-center hover:bg-gray-50 text-gray-600 font-medium transition-colors duration-200">−</button>
                                <input type="number" value="2" min="1"
                                       class="w-12 text-center border border-gray-300 rounded py-1 text-gray-900 font-medium focus:outline-none focus:border-amber-800">
                                <button class="w-8 h-8 border border-gray-300 rounded flex items-center justify-center hover:bg-gray-50 text-gray-600 font-medium transition-colors duration-200">+</button>
                            </div>
                            <span class="text-amber-800 font-bold text-xl">1 700 ₽</span>
                            <button class="text-red-400 hover:text-red-600 transition-colors duration-200" title="Удалить">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Товар 2 --}}
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 flex items-center gap-4">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Зелёный чай Сенча</h3>
                        <p class="text-sm text-gray-500 mb-3">Чай</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <button class="w-8 h-8 border border-gray-300 rounded flex items-center justify-center hover:bg-gray-50 text-gray-600 font-medium transition-colors duration-200">−</button>
                                <input type="number" value="1" min="1"
                                       class="w-12 text-center border border-gray-300 rounded py-1 text-gray-900 font-medium focus:outline-none focus:border-amber-800">
                                <button class="w-8 h-8 border border-gray-300 rounded flex items-center justify-center hover:bg-gray-50 text-gray-600 font-medium transition-colors duration-200">+</button>
                            </div>
                            <span class="text-amber-800 font-bold text-xl">420 ₽</span>
                            <button class="text-red-400 hover:text-red-600 transition-colors duration-200" title="Удалить">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Товар 3 --}}
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 flex items-center gap-4">
                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Колумбийский Супремо</h3>
                        <p class="text-sm text-gray-500 mb-3">Свежеобжаренный кофе</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <button class="w-8 h-8 border border-gray-300 rounded flex items-center justify-center hover:bg-gray-50 text-gray-600 font-medium transition-colors duration-200">−</button>
                                <input type="number" value="1" min="1"
                                       class="w-12 text-center border border-gray-300 rounded py-1 text-gray-900 font-medium focus:outline-none focus:border-amber-800">
                                <button class="w-8 h-8 border border-gray-300 rounded flex items-center justify-center hover:bg-gray-50 text-gray-600 font-medium transition-colors duration-200">+</button>
                            </div>
                            <span class="text-amber-800 font-bold text-xl">1 100 ₽</span>
                            <button class="text-red-400 hover:text-red-600 transition-colors duration-200" title="Удалить">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Панель итога --}}
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 h-fit sticky top-20">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Итого</h2>

                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Товары (4 шт.)</span>
                        <span>3 220 ₽</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Доставка</span>
                        <span>300 ₽</span>
                    </div>
                </div>

                <div class="flex justify-between font-bold text-gray-900 text-lg border-t border-gray-200 pt-4">
                    <span>Итого</span>
                    <span class="text-amber-800">3 520 ₽</span>
                </div>

                <button class="w-full bg-amber-800 hover:bg-amber-700 text-white py-3 rounded-lg font-medium transition-colors duration-200 mt-6">
                    Оформить заказ
                </button>

                <a href="{{ route('home') }}"
                   class="block text-center text-amber-800 hover:text-amber-600 font-medium mt-4 transition-colors duration-200">
                    ← Продолжить покупки
                </a>
            </div>

        </div>

        {{-- Пустая корзина (скрыта, показывается когда корзина пуста) --}}
        <div class="hidden text-center py-20">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Корзина пуста</h2>
            <p class="text-gray-600 mb-8">Добавьте товары из каталога, чтобы оформить заказ</p>
            <a href="{{ route('home') }}"
               class="inline-block bg-amber-800 hover:bg-amber-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200">
                Перейти в каталог
            </a>
        </div>

    </div>
@endsection
