@extends('layouts.main-layout')

@section('title', 'Админ-панель')

@section('content')
    <div class="flex min-h-screen bg-gray-100">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0">
            <div class="p-6 border-b border-gray-800">
                <h2 class="text-xl font-bold text-amber-400">Админ-панель</h2>
                <p class="text-sm text-gray-400 mt-1">coffee-tea-shop</p>
            </div>
            <nav class="p-4 space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-amber-800 rounded-lg text-white font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Дашборд
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Товары
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Категории
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Заказы
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Пользователи
                </a>
            </nav>
        </aside>

        {{-- Основной контент --}}
        <main class="flex-1 p-8">

            {{-- Заголовок --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Дашборд</h1>
                <p class="text-gray-600 mt-1">Обзор магазина за сегодня</p>
            </div>

            {{-- Статистика --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Карточка 1 --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">48</p>
                    <p class="text-sm text-gray-500 mt-1">Товаров</p>
                </div>

                {{-- Карточка 2 --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">127</p>
                    <p class="text-sm text-gray-500 mt-1">Заказов</p>
                </div>

                {{-- Карточка 3 --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">89</p>
                    <p class="text-sm text-gray-500 mt-1">Пользователей</p>
                </div>

                {{-- Карточка 4 --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">284 500 ₽</p>
                    <p class="text-sm text-gray-500 mt-1">Выручка</p>
                </div>

            </div>

            {{-- Последние заказы --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Последние заказы</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">№</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Клиент</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Сумма</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Статус</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900 font-medium">#127</td>
                                <td class="py-4 px-6 text-gray-600">Иван Петров</td>
                                <td class="py-4 px-6 text-gray-900 font-medium">4 520 ₽</td>
                                <td class="py-4 px-6">
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Ожидает
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">10.09.2026</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900 font-medium">#126</td>
                                <td class="py-4 px-6 text-gray-600">Мария Сидорова</td>
                                <td class="py-4 px-6 text-gray-900 font-medium">2 100 ₽</td>
                                <td class="py-4 px-6">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                        В об��аботке
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">10.09.2026</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900 font-medium">#125</td>
                                <td class="py-4 px-6 text-gray-600">Алексей Козлов</td>
                                <td class="py-4 px-6 text-gray-900 font-medium">8 340 ₽</td>
                                <td class="py-4 px-6">
                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Выполнен
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">09.09.2026</td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900 font-medium">#124</td>
                                <td class="py-4 px-6 text-gray-600">Елена Новикова</td>
                                <td class="py-4 px-6 text-gray-900 font-medium">1 750 ₽</td>
                                <td class="py-4 px-6">
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Ожидает
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">09.09.2026</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900 font-medium">#123</td>
                                <td class="py-4 px-6 text-gray-600">Дмитрий Волков</td>
                                <td class="py-4 px-6 text-gray-900 font-medium">3 220 ₽</td>
                                <td class="py-4 px-6">
                                    <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Выполнен
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">08.09.2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Быстрые действия --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <button class="flex items-center justify-center gap-2 bg-amber-800 hover:bg-amber-700 text-white py-3 px-6 rounded-lg font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Добавить товар
                </button>
                <button class="flex items-center justify-center gap-2 bg-amber-800 hover:bg-amber-700 text-white py-3 px-6 rounded-lg font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Добавить категорию
                </button>
            </div>

        </main>

    </div>
@endsection
