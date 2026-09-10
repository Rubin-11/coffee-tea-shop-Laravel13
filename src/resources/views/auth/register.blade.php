{{-- Регистрация (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Регистрация')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Регистрация</h1>
            <p class="mt-2 text-sm text-body">Создайте аккаунт, чтобы отслеживать заказы и получать скидки.</p>

            <form class="mt-6 space-y-4">
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Имя и фамилия</span><input type="text" class="field" placeholder="Иван Иванов"></label>
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Email</span><input type="email" class="field" placeholder="you@example.com"></label>
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Пароль</span><input type="password" class="field" placeholder="••••••••"></label>
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Повторите пароль</span><input type="password" class="field" placeholder="••••••••"></label>

                <label class="flex items-start gap-2 text-[13px] text-muted">
                    <input type="checkbox" class="mt-0.5 h-4 w-4 shrink-0 accent-accent">
                    <span>Согласен(на) с условиями обработки персональных данных и <a href="/pages/privacy" class="underline hover:text-accent">политикой конфиденциальности</a></span>
                </label>

                <button type="submit" class="btn-accent w-full py-3.5">Зарегистрироваться</button>
            </form>

            <p class="mt-6 text-center text-sm text-body">Уже есть аккаунт? <a href="/auth/login" class="font-semibold text-ink transition-colors hover:text-accent">Войти</a></p>
        </div>
    </div>
@endsection
