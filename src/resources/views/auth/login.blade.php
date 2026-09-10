{{-- Вход (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Вход в личный кабинет')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Вход</h1>
            <p class="mt-2 text-sm text-body">Войдите, чтобы отслеживать заказы и оформлять их быстрее.</p>

            <form class="mt-6 space-y-4">
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Email</span><input type="email" class="field" placeholder="you@example.com"></label>
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Пароль</span><input type="password" class="field" placeholder="••••••••"></label>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-body"><input type="checkbox" class="accent-accent"> Запомнить меня</label>
                    <a href="/auth/forgot-password" class="text-body transition-colors hover:text-accent">Забыли пароль?</a>
                </div>

                <button type="submit" class="btn-accent w-full py-3.5">Войти</button>
            </form>

            <p class="mt-6 text-center text-sm text-body">Нет аккаунта? <a href="/auth/register" class="font-semibold text-ink transition-colors hover:text-accent">Зарегистрироваться</a></p>
        </div>
    </div>
@endsection
