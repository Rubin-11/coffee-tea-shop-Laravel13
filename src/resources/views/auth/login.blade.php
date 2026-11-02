{{-- Вход --}}
@extends('layouts.main-layout')

@section('title', 'Вход в личный кабинет')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Вход</h1>
            <p class="mt-2 text-sm text-body">Войдите, чтобы отслеживать заказы и оформлять их быстрее.</p>

            @if (session('status'))
                <p class="mt-4 text-sm text-body">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" class="field" placeholder="you@example.com" required autofocus autocomplete="username">
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Пароль</span>
                    <input type="password" name="password" class="field" placeholder="••••••••" required autocomplete="current-password">
                </label>

                @if ($errors->any())
                    <ul class="list-disc space-y-1 pl-4 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-body">
                        <input type="checkbox" name="remember" class="accent-accent"> Запомнить меня
                    </label>
                    <a href="{{ route('password.request') }}" class="text-body transition-colors hover:text-accent">Забыли пароль?</a>
                </div>

                <button type="submit" class="btn-accent w-full py-3.5">Войти</button>
            </form>

            <p class="mt-6 text-center text-sm text-body">Нет аккаунта? <a href="{{ route('register') }}" class="font-semibold text-ink transition-colors hover:text-accent">Зарегистрироваться</a></p>
        </div>
    </div>
@endsection
