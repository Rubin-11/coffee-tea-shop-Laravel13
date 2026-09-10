{{-- Блог: список статей (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Блог Coffee-Tea Shop')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Блог</h1>
        <p class="mt-3 max-w-2xl text-body">Новости компании, рецепты, статьи о кофе и чае.</p>

        {{-- Категории --}}
        <div class="mt-6 flex flex-wrap gap-2">
            <a href="#" class="rounded-full bg-accent px-4 py-2 text-sm font-semibold text-white">Все</a>
            <a href="#" class="rounded-full border border-line px-4 py-2 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">Новости</a>
            <a href="#" class="rounded-full border border-line px-4 py-2 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">Рецепты</a>
            <a href="#" class="rounded-full border border-line px-4 py-2 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">О кофе</a>
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <article class="flex flex-col overflow-hidden rounded-card border border-line bg-white shadow-card">
                <span class="grid aspect-[16/9] place-items-center bg-soft text-[#cfcfcf]">
                    <svg class="h-14 w-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                </span>
                <div class="flex flex-1 flex-col p-6">
                    <span class="text-sm text-muted">05.09.2026 · Новости</span>
                    <h3 class="mt-2 text-xl font-bold text-ink">Танзанийский кофе: путешествие в сердце Африки</h3>
                    <p class="mt-2 line-clamp-3 text-body">Рассказываем, чем уникален кофе из Танзании и почему его стоит попробовать.</p>
                    <a href="/blog/tanzaniyskiy-kofe" class="mt-auto pt-4 text-sm font-semibold text-ink transition-colors hover:text-accent">Читать далее →</a>
                </div>
            </article>

            <article class="flex flex-col overflow-hidden rounded-card border border-line bg-white shadow-card">
                <span class="grid aspect-[16/9] place-items-center bg-soft text-[#cfcfcf]">
                    <svg class="h-14 w-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                </span>
                <div class="flex flex-1 flex-col p-6">
                    <span class="text-sm text-muted">28.08.2026 · О кофе</span>
                    <h3 class="mt-2 text-xl font-bold text-ink">Как правильно хранить кофе дома</h3>
                    <p class="mt-2 line-clamp-3 text-body">Простые правила, которые помогут сохранить аромат и вкус зёрен надолго.</p>
                    <a href="/blog/kak-hranit-kofe" class="mt-auto pt-4 text-sm font-semibold text-ink transition-colors hover:text-accent">Читать далее →</a>
                </div>
            </article>

            <article class="flex flex-col overflow-hidden rounded-card border border-line bg-white shadow-card">
                <span class="grid aspect-[16/9] place-items-center bg-soft text-[#cfcfcf]">
                    <svg class="h-14 w-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                </span>
                <div class="flex flex-1 flex-col p-6">
                    <span class="text-sm text-muted">15.08.2026 · Рецепты</span>
                    <h3 class="mt-2 text-xl font-bold text-ink">Как заварить идеальный френч-пресс</h3>
                    <p class="mt-2 line-clamp-3 text-body">Пошаговая инструкция и три ошибки, которые портят вкус напитка.</p>
                    <a href="/blog/french-press" class="mt-auto pt-4 text-sm font-semibold text-ink transition-colors hover:text-accent">Читать далее →</a>
                </div>
            </article>
        </div>

        @include('components.pagination')
    </div>
@endsection
