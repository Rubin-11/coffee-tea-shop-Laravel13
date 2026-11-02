{{-- Регистрация --}}
@extends('layouts.main-layout')

@section('title', 'Регистрация')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Регистрация</h1>
            <p class="mt-2 text-sm text-body">Создайте аккаунт, чтобы отслеживать заказы и получать скидки.</p>

            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                @csrf

                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Имя</span>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="field" placeholder="Иван" required autofocus autocomplete="given-name">
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Фамилия</span>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="field" placeholder="Иванов" required autocomplete="family-name">
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" class="field" placeholder="you@example.com" required autocomplete="username">
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Пароль</span>
                    <input type="password" name="password" class="field" placeholder="••••••••" required autocomplete="new-password">
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Повторите пароль</span>
                    <input type="password" name="password_confirmation" class="field" placeholder="••••••••" required autocomplete="new-password">
                </label>

                @if ($errors->any())
                    <ul class="list-disc space-y-1 pl-4 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <button type="submit" class="btn-accent w-full py-3.5">Зарегистрироваться</button>
            </form>

            <p class="mt-6 text-center text-sm text-body">Уже есть аккаунт? <a href="{{ route('login') }}" class="font-semibold text-ink transition-colors hover:text-accent">Войти</a></p>
        </div>
    </div>
@endsection
