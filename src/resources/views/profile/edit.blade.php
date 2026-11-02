{{-- Профиль: имя, почта, пароль. Заказы и адреса — не этот этап --}}
@extends('layouts.main-layout')

@section('title', 'Профиль')

@section('content')
    <div class="wrap py-14">
        <div class="mx-auto max-w-md space-y-8">
            <div class="rounded-card border border-line bg-white p-8 shadow-card">
                <h1 class="text-[28px] font-extrabold text-ink">Профиль</h1>
                <p class="mt-2 text-sm text-body">{{ $user->first_name }} {{ $user->last_name }}</p>

                @if (session('status') === 'profile-updated')
                    <p class="mt-4 text-sm text-body">Данные сохранены.</p>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
                    @csrf
                    @method('PATCH')

                    <label class="block">
                        <span class="mb-1.5 block text-sm text-muted">Имя</span>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="field" required autocomplete="given-name">
                    </label>
                    <label class="block">
                        <span class="mb-1.5 block text-sm text-muted">Фамилия</span>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="field" required autocomplete="family-name">
                    </label>
                    <label class="block">
                        <span class="mb-1.5 block text-sm text-muted">Email</span>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="field" required autocomplete="username">
                    </label>

                    @if ($errors->any() && ! $errors->updatePassword->any() && ! $errors->userDeletion->any())
                        <ul class="list-disc space-y-1 pl-4 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <button type="submit" class="btn-accent w-full py-3.5">Сохранить</button>
                </form>
            </div>

            <div class="rounded-card border border-line bg-white p-8 shadow-card">
                <h2 class="text-xl font-extrabold text-ink">Новый пароль</h2>

                @if (session('status') === 'password-updated')
                    <p class="mt-4 text-sm text-body">Пароль обновлён.</p>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <label class="block">
                        <span class="mb-1.5 block text-sm text-muted">Текущий пароль</span>
                        <input type="password" name="current_password" class="field" required autocomplete="current-password">
                    </label>
                    <label class="block">
                        <span class="mb-1.5 block text-sm text-muted">Новый пароль</span>
                        <input type="password" name="password" class="field" required autocomplete="new-password">
                    </label>
                    <label class="block">
                        <span class="mb-1.5 block text-sm text-muted">Повторите пароль</span>
                        <input type="password" name="password_confirmation" class="field" required autocomplete="new-password">
                    </label>

                    @if ($errors->updatePassword->any())
                        <ul class="list-disc space-y-1 pl-4 text-sm text-red-700">
                            @foreach ($errors->updatePassword->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <button type="submit" class="btn-accent w-full py-3.5">Обновить пароль</button>
                </form>
            </div>

            <div class="rounded-card border border-line bg-white p-8 shadow-card">
                <h2 class="text-xl font-extrabold text-ink">Удалить аккаунт</h2>
                <p class="mt-2 text-sm text-body">Аккаунт и корзина будут удалены. Это нельзя отменить.</p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-4">
                    @csrf
                    @method('DELETE')

                    <label class="block">
                        <span class="mb-1.5 block text-sm text-muted">Пароль</span>
                        <input type="password" name="password" class="field" required autocomplete="current-password">
                    </label>

                    @if ($errors->userDeletion->any())
                        <ul class="list-disc space-y-1 pl-4 text-sm text-red-700">
                            @foreach ($errors->userDeletion->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <button type="submit" class="btn-dark w-full py-3.5">Удалить аккаунт</button>
                </form>
            </div>
        </div>
    </div>
@endsection
