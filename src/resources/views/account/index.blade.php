{{-- Личный кабинет: сводка (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Личный кабинет')

@section('content')
    <div class="wrap py-10">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Личный кабинет</h1>

        <div class="mt-8 grid gap-8 lg:grid-cols-[260px_1fr]">
            @include('components.account-nav')

            <div class="space-y-6">
                <section class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Здравствуйте, Иван!</h2>
                    <dl class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div><dt class="text-sm text-muted">Имя</dt><dd class="font-semibold text-ink">Иван Иванов</dd></div>
                        <div><dt class="text-sm text-muted">Email</dt><dd class="font-semibold text-ink">ivan@example.com</dd></div>
                        <div><dt class="text-sm text-muted">Телефон</dt><dd class="font-semibold text-ink">+7 (999) 123-45-67</dd></div>
                        <div><dt class="text-sm text-muted">Дата рождения</dt><dd class="font-semibold text-ink">01.01.1990</dd></div>
                    </dl>
                    <a href="/account/edit" class="btn-outline mt-6 px-6 py-3">Редактировать</a>
                </section>

                <section class="grid gap-6 sm:grid-cols-2">
                    <a href="/account/orders" class="rounded-card border border-line bg-white p-6 shadow-card transition-shadow hover:shadow-card-hover">
                        <div class="text-3xl font-extrabold text-ink">3</div>
                        <div class="mt-1 text-body">Активных заказа</div>
                    </a>
                    <a href="/account/orders" class="rounded-card border border-line bg-white p-6 shadow-card transition-shadow hover:shadow-card-hover">
                        <div class="text-3xl font-extrabold text-ink">12</div>
                        <div class="mt-1 text-body">Завершённых заказов</div>
                    </a>
                </section>
            </div>
        </div>
    </div>
@endsection
