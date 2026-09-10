{{-- Забыли пароль — шаг 2: новый пароль (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Новый пароль')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Новый пароль</h1>
            <p class="mt-2 text-sm text-body">Придумайте новый пароль для входа.</p>

            <form class="mt-6 space-y-4">
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Email</span><input type="email" class="field" placeholder="you@example.com"></label>
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Новый пароль</span><input type="password" class="field" placeholder="••••••••"></label>
                <label class="block"><span class="mb-1.5 block text-sm text-muted">Повторите пароль</span><input type="password" class="field" placeholder="••••••••"></label>
                <button type="submit" class="btn-accent w-full py-3.5">Сохранить пароль</button>
            </form>
        </div>
    </div>
@endsection
