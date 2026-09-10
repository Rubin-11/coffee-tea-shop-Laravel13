@extends('layouts.main-layout')

@section('title', 'Эфиопский Иргачеф')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Хлебные крошки --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-amber-800 transition-colors duration-200">Главная</a>
            <span>/</span>
            <a href="#" class="hover:text-amber-800 transition-colors duration-200">Каталог</a>
            <span>/</span>
            <a href="#" class="hover:text-amber-800 transition-colors duration-200">Свежеобжаренный кофе</a>
            <span>/</span>
            <span class="text-gray-900">Эфиопский Иргачеф</span>
        </nav>

        {{-- Основной блок --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">

            {{-- Левая: галерея --}}
            <div>
                {{-- Главное фото --}}
                <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl h-96 flex items-center justify-center mb-4">
                    <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                {{-- Миниатюры --}}
                <div class="flex gap-3">
                    <div class="w-20 h-20 rounded-lg border-2 border-amber-800 cursor-pointer bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="w-20 h-20 rounded-lg border-2 border-gray-200 hover:border-amber-800 cursor-pointer bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center transition-colors duration-200">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="w-20 h-20 rounded-lg border-2 border-gray-200 hover:border-amber-800 cursor-pointer bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center transition-colors duration-200">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Правая: информация --}}
            <div>
                {{-- Бейдж категории --}}
                <span class="inline-block text-sm text-amber-800 font-medium bg-amber-50 px-3 py-1 rounded-full mb-3">
                    Свежеобжаренный кофе
                </span>

                {{-- Заголовок --}}
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Эфиопский Иргачеф</h1>

                {{-- Рейтинг --}}
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span class="text-sm text-gray-500">4.8 (124 отзыва)</span>
                </div>

                {{-- Цена --}}
                <p class="text-4xl font-bold text-amber-800 mb-6">850 ₽</p>

                {{-- Описание --}}
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Эфиопский Иргачеф — кофе с ярким фруктовым вкусом и лёгкими цветочными нотами.
                    Обжарен на свежесобранных зёрнах с нотами черники, жасмина и цитруса.
                    Идеален для альтернативного заваривания и френч-пресса.
                </p>

                {{-- Наличие --}}
                <p class="text-green-600 font-medium mb-6">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    В наличии: 47 шт.
                </p>

                {{-- Счётчик и кнопка --}}
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <button class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors duration-200">−</button>
                        <input type="number" value="1" min="1"
                               class="w-12 text-center border-none focus:outline-none text-gray-900 font-medium">
                        <button class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors duration-200">+</button>
                    </div>
                    <button class="flex-1 bg-amber-800 hover:bg-amber-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        В корзину
                    </button>
                </div>
            </div>

        </div>

        {{-- Характеристики --}}
        <section class="mb-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Характеристики</h2>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="flex justify-between py-3 px-4 border-b border-gray-200">
                    <span class="text-gray-600">Страна происхождения</span>
                    <span class="text-gray-900 font-medium">Эфиопия</span>
                </div>
                <div class="flex justify-between py-3 px-4 border-b border-gray-200 bg-gray-50">
                    <span class="text-gray-600">Обжарка</span>
                    <span class="text-gray-900 font-medium">Средняя</span>
                </div>
                <div class="flex justify-between py-3 px-4 border-b border-gray-200">
                    <span class="text-gray-600">Помол</span>
                    <span class="text-gray-900 font-medium">Зерно</span>
                </div>
                <div class="flex justify-between py-3 px-4 border-b border-gray-200 bg-gray-50">
                    <span class="text-gray-600">Вес</span>
                    <span class="text-gray-900 font-medium">250 г</span>
                </div>
                <div class="flex justify-between py-3 px-4">
                    <span class="text-gray-600">Вкусовые ноты</span>
                    <span class="text-gray-900 font-medium">Черника, жасмин, цитрус</span>
                </div>
            </div>
        </section>

        {{-- Похожие товары --}}
        <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Похожие товары</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Карточка 1 --}}
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
                    <div class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Колумбийский Супремо</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                            Классический колумбийский кофе с мягким шоколадным вкусом и ореховыми нотами.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-amber-800 font-bold text-2xl">1 100 ₽</span>
                            <button class="bg-amber-800 hover:bg-amber-700 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                В корзину
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Карточка 2 --}}
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
                    <div class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Бразильский Сантос</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                            Мягкий бразильский кофе с низким содержанием кислоты и шоколадно-ореховым послевкусием.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-amber-800 font-bold text-2xl">750 ₽</span>
                            <button class="bg-amber-800 hover:bg-amber-700 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                В корзину
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Карточка 3 --}}
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200">
                    <div class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Кенийский АА</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                            Яркий кенийский кофе с фруктовой кислотностью и нотами чёрной смородины.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-amber-800 font-bold text-2xl">980 ₽</span>
                            <button class="bg-amber-800 hover:bg-amber-700 text-white px-5 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                В корзину
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
@endsection
