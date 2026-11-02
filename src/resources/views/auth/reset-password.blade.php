{{-- Новый пароль по ссылке из письма --}}
@extends('layouts.main-layout')

@section('title', 'Новый пароль')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Новый пароль</h1>
            <p class="mt-2 text-sm text-body">Придумайте новый пароль для входа.</p>

            <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Email</span>
                    <input type="email" name="email" value="{{ old('email', request('email')) }}" class="field" placeholder="you@example.com" required autofocus autocomplete="username">
                </label>
                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Новый пароль</span>
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

                <button type="submit" class="btn-accent w-full py-3.5">Сохранить пароль</button>
            </form>
        </div>
    </div>
@endsection
