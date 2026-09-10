{{-- 500 — ошибка сервера (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Ошибка сервера')

@section('content')
    <div class="wrap py-24 text-center">
        <div class="text-[96px] font-extrabold leading-none text-accent">500</div>
        <h1 class="mt-4 text-[30px] font-extrabold text-ink">Что-то пошло не так</h1>
        <p class="mx-auto mt-3 max-w-md text-body">Мы уже чиним. Попробуйте обновить страницу чуть позже.</p>
        <a href="/" class="btn-accent mt-8 px-7 py-3.5">На главную</a>
    </div>
@endsection
