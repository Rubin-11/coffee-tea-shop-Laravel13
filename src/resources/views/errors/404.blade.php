{{-- 404 — страница не найдена (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Страница не найдена')

@section('content')
    <div class="wrap py-24 text-center">
        <div class="text-[96px] font-extrabold leading-none text-accent">404</div>
        <h1 class="mt-4 text-[30px] font-extrabold text-ink">Страница не найдена</h1>
        <p class="mx-auto mt-3 max-w-md text-body">Возможно, страница была удалена или вы ошиблись в адресе.</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="/" class="btn-accent px-7 py-3.5">На главную</a>
            <a href="/catalog" class="btn-outline px-7 py-3.5">В каталог</a>
        </div>
    </div>
@endsection
