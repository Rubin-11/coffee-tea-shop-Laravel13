{{-- Забыли пароль — шаг 1 (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Восстановление пароля</h1>
            <p class="mt-2 text-sm text-body">Укажите email — мы отправим ссылку для сброса пароля.</p>

            <form class="mt-6 space-y-4">
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Email</span><input type="email" class="field" placeholder="you@example.com"></label>
                <button type="submit" class="btn-accent w-full py-3.5">Отправить ссылку</button>
            </form>

            <p class="mt-6 text-center text-sm text-body"><a href="/auth/login" class="font-semibold text-ink transition-colors hover:text-accent">← Вернуться ко входу</a></p>
        </div>
    </div>
@endsection
