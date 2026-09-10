{{-- Информационная страница: Пользовательское соглашение (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Пользовательское соглашение — Coffee-Tea Shop')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap max-w-4xl pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Пользовательское соглашение</h1>
        <div class="mt-6 space-y-4 text-[17px] leading-relaxed text-body">
            <p>Используя сайт, вы соглашаетесь с настоящими условиями. Мы оставляем за собой право изменять их без предварительного уведомления.</p>
            <p>Вся информация на сайте носит справочный характер и не является публичной офертой.</p>
        </div>
    </div>
@endsection
