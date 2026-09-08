@extends('layouts.main-layout')
@section('title', 'Главная')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Hero Section --}}
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">
                Добро пожаловать в магазин чая и кофе! ☕
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Откройте для себя мир изысканных напитков со всего мира
            </p>
        </div>

        {{-- Categories Section --}}
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Категории товаров</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    @if(!isset($category->parent_id))
                        <a href="{{ route('category', $category->slug) }}"
                           class="group block bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold text-gray-800 group-hover:text-amber-800 transition-colors duration-300">
                                        {{ $category->name }}
                                    </h3>
                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-amber-800 group-hover:translate-x-2 transition-all duration-300"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </section>

        {{-- Features Section --}}
        <section class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-8 mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Почему выбирают нас?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-amber-800 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Лучшее качество</h3>
                    <p class="text-gray-600">Только отборные сорта чая и кофе от проверенных поставщиков</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-amber-800 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Быстрая доставка</h3>
                    <p class="text-gray-600">Доставим ваш заказ в кратчайшие сроки по всей России</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-amber-800 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Отличные цены</h3>
                    <p class="text-gray-600">Конкурентные цены и регулярные акции для наших клиентов</p>
                </div>
            </div>
        </section>
    </div>
@endsection

