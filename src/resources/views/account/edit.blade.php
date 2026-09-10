{{-- Личный кабинет: редактирование профиля (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Редактирование профиля')

@section('content')
    <div class="wrap py-10">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Редактирование профиля</h1>

        <div class="mt-8 grid gap-8 lg:grid-cols-[260px_1fr]">
            @include('components.account-nav')

            <form class="space-y-6">
                <section class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Личные данные</h2>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Имя</span><input type="text" class="field" value="Иван" placeholder="Имя"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Фамилия</span><input type="text" class="field" value="Иванов" placeholder="Фамилия"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Email</span><input type="email" class="field" value="ivan@example.com"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Телефон</span><input type="tel" class="field" value="+7 (999) 123-45-67"></label>
                    </div>
                </section>

                <section class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Адрес доставки</h2>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Город</span><input type="text" class="field" value="Калининград"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Улица, дом, кв.</span><input type="text" class="field" value="ул. Кофейная, 1"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Индекс</span><input type="text" class="field" value="236000"></label>
                    </div>
                </section>

                <section class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Смена пароля</h2>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Новый пароль</span><input type="password" class="field" placeholder="••••••••"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Повторите пароль</span><input type="password" class="field" placeholder="••••••••"></label>
                    </div>
                </section>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="btn-accent px-8 py-3.5">Сохранить</button>
                    <a href="/account" class="btn-outline px-8 py-3.5">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection
