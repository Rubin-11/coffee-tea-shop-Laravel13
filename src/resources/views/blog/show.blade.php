{{-- Блог: статья (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Танзанийский кофе: путешествие в сердце Африки')

@section('content')
    @include('components.breadcrumbs')

    <article class="wrap pb-16">
        <div class="mx-auto max-w-3xl">
            <span class="text-sm text-muted">05.09.2026 · Новости</span>
            <h1 class="mt-2 text-[34px] font-extrabold text-ink sm:text-[42px]">Танзанийский кофе: путешествие в сердце Африки</h1>

            <span class="mt-6 grid aspect-[16/8] place-items-center rounded-card bg-soft text-[#cfcfcf]">
                <svg class="h-20 w-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
            </span>

            <div class="mt-8 space-y-4 text-[17px] leading-relaxed text-body">
                <p>Танзания — одна из тех стран, где кофе растёт на склонах вулканов Килиманджаро и Меру. Уникальный терруар и высокогорье придают зёрнам яркую кислотность и ягодные ноты.</p>
                <p>Большая часть урожая — арабика сортов Бурбон и Кенту. Обработка чаще всего мытая, что делает вкус чистым и сбалансированным.</p>
                <h2 class="pt-4 text-2xl font-extrabold text-ink">Как заваривать</h2>
                <p>Танзанийский кофе отлично раскрывается в воронке и аэропрессе: светлая обжарка подчёркивает фруктовые ноты, а средняя — шоколадные.</p>
                <blockquote class="border-l-4 border-accent bg-accent-soft px-5 py-4 text-ink">«Танзанийский кофе — это баланс между яркостью кенийского и мягкостью колумбийского».</blockquote>
                <p>Попробуйте наши сорта из Танзании — они уже в каталоге.</p>
            </div>

            <div class="mt-10 flex flex-wrap items-center gap-3">
                <span class="text-sm text-muted">Метки:</span>
                <a href="#" class="rounded-full bg-soft px-3 py-1 text-sm text-body transition-colors hover:text-accent">#кофе</a>
                <a href="#" class="rounded-full bg-soft px-3 py-1 text-sm text-body transition-colors hover:text-accent">#африка</a>
            </div>

            <a href="/blog" class="btn-outline mt-8 px-7 py-3.5">← Ко всем статьям</a>
        </div>
    </article>
@endsection
