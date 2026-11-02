{{-- Запрос ссылки для сброса пароля --}}
@extends('layouts.main-layout')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Восстановление пароля</h1>
            <p class="mt-2 text-sm text-body">Укажите email — мы отправим ссылку для сброса пароля.</p>

            @if (session('status'))
                <p class="mt-4 text-sm text-body">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
                @csrf

                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" class="field" placeholder="you@example.com" required autofocus autocomplete="username">
                </label>

                @if ($errors->any())
                    <ul class="list-disc space-y-1 pl-4 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <button type="submit" class="btn-accent w-full py-3.5">Отправить ссылку</button>
            </form>

            <p class="mt-6 text-center text-sm text-body"><a href="{{ route('login') }}" class="font-semibold text-ink transition-colors hover:text-accent">← Вернуться ко входу</a></p>
        </div>
    </div>
@endsection
