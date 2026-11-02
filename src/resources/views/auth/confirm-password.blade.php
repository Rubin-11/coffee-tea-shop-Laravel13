{{-- Повторный ввод пароля перед чувствительным действием --}}
@extends('layouts.main-layout')

@section('title', 'Подтверждение пароля')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md rounded-card border border-line bg-white p-8 shadow-card">
            <h1 class="text-[28px] font-extrabold text-ink">Подтвердите пароль</h1>
            <p class="mt-2 text-sm text-body">Это защищённый раздел. Введите пароль ещё раз.</p>

            <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-4">
                @csrf

                <label class="block">
                    <span class="mb-1.5 block text-sm text-muted">Пароль</span>
                    <input type="password" name="password" class="field" required autofocus autocomplete="current-password">
                </label>

                @if ($errors->any())
                    <ul class="list-disc space-y-1 pl-4 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <button type="submit" class="btn-accent w-full py-3.5">Подтвердить</button>
            </form>
        </div>
    </div>
@endsection
