{{-- Главная страница (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Coffee-Tea Shop — свежеобжаренный кофе и премиальный чай')

@section('content')
    {{-- ============ 1. HERO ============ --}}
    <section class="bg-accent-soft">
        <div class="wrap grid items-center gap-10 py-14 lg:grid-cols-2 lg:py-20">
            <div>
                <h1 class="text-[40px] font-extrabold leading-[1.1] text-ink sm:text-[56px] lg:text-[64px]">
                    Свежеобжаренный кофе
                </h1>
                <p class="mt-5 max-w-lg text-[17px] leading-relaxed text-body">
                    Кофе Калининградской обжарки из разных стран произрастания с доставкой на дом.
                    Мы обжариваем кофе каждые выходные.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="/catalog" class="btn-accent px-8 py-4 text-base">Посмотреть каталог</a>
                    <a href="/pages/about" class="btn-outline px-8 py-4 text-base">О компании</a>
                </div>
            </div>

            <div class="relative flex justify-center">
                <div class="grid aspect-square w-full max-w-md place-items-center rounded-card bg-white/70 text-[#e2c89a] shadow-card">
                    <svg class="h-32 w-32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                        <line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 2. КАТАЛОГИ НАШЕЙ ПРОДУКЦИИ ============ --}}
    <section class="wrap py-14 lg:py-20" id="catalog">
        <h2 class="section-title">Каталоги нашей продукции</h2>
        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @include('components.category-card')
            @include('components.category-card')
            @include('components.category-card')
            @include('components.category-card')
        </div>
    </section>

    {{-- ============ 3. ТОВАРЫ СО СКИДКОЙ ============ --}}
    <section class="bg-soft py-14 lg:py-20">
        <div class="wrap">
            <div class="flex items-end justify-between gap-4">
                <h2 class="section-title">Товары со скидкой</h2>
                <a href="/catalog?discount=1" class="text-[15px] font-semibold text-ink transition-colors hover:text-accent">Все скидки →</a>
            </div>
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @include('components.product-card')
                @include('components.product-card')
                @include('components.product-card')
                @include('components.product-card')
            </div>
        </div>
    </section>

    {{-- ============ 4. ПОЧЕМУ МЫ ============ --}}
    <section class="wrap py-14 lg:py-20">
        <h2 class="section-title">Почему стоит работать именно с нами?</h2>
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-card border border-line bg-white p-8 shadow-card">
                <span class="grid h-14 w-14 place-items-center rounded-full bg-accent-soft text-accent-dark">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </span>
                <h3 class="mt-5 text-xl font-bold text-ink">Лучшие цены</h3>
                <p class="mt-2 text-body">Прямые поставки с плантаций и собственная обжарка позволяют держать честные цены без лишних наценок.</p>
            </div>
            <div class="rounded-card border border-line bg-white p-8 shadow-card">
                <span class="grid h-14 w-14 place-items-center rounded-full bg-accent-soft text-accent-dark">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path></svg>
                </span>
                <h3 class="mt-5 text-xl font-bold text-ink">Всегда свежая обжарка</h3>
                <p class="mt-2 text-body">Обжариваем кофе небольшими партиями сразу после заказа, чтобы вы получали максимально свежий продукт.</p>
            </div>
            <div class="rounded-card border border-line bg-white p-8 shadow-card">
                <span class="grid h-14 w-14 place-items-center rounded-full bg-accent-soft text-accent-dark">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                </span>
                <h3 class="mt-5 text-xl font-bold text-ink">Консультации 24/7</h3>
                <p class="mt-2 text-body">Поможем подобрать сорт под ваш вкус и способ приготовления — в любое время дня и ночи.</p>
            </div>
        </div>
    </section>

    {{-- ============ 5. КАК МЫ ОБЖАРИВАЕМ ============ --}}
    <section class="bg-soft py-14 lg:py-20">
        <div class="wrap grid items-center gap-10 lg:grid-cols-2">
            <div class="grid aspect-[4/3] place-items-center rounded-card bg-white text-[#e2c89a] shadow-card">
                <svg class="h-24 w-24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2z"></path><path d="M8 12a4 4 0 0 1 8 0"></path>
                </svg>
            </div>
            <div>
                <h2 class="section-title">Как мы обжариваем наш кофе</h2>
                <p class="mt-5 text-body">
                    Мы обжариваем кофе в Калининграде на современном ростере, небольшими партиями и под строгим контролем профиля обжарки.
                </p>
                <p class="mt-4 text-body">
                    Каждый сорт раскрывается по-своему: от светлой обжарки с яркой кислинкой до тёмной — с плотным телом и горчинкой.
                    Благодаря этому кофе сохраняет аромат и свежесть в каждой чашке.
                </p>
            </div>
        </div>
    </section>

    {{-- ============ 6. НОВОСТИ КОМПАНИИ ============ --}}
    <section class="wrap py-14 lg:py-20">
        <div class="flex items-end justify-between gap-4">
            <h2 class="section-title">Новости компании</h2>
            <a href="/blog" class="text-[15px] font-semibold text-ink transition-colors hover:text-accent">Читать все →</a>
        </div>
        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <article class="flex flex-col overflow-hidden rounded-card border border-line bg-white shadow-card">
                <span class="grid aspect-[16/7] place-items-center bg-soft text-[#cfcfcf]">
                    <svg class="h-14 w-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                </span>
                <div class="p-6">
                    <span class="text-sm text-muted">05.09.2026</span>
                    <h3 class="mt-2 text-xl font-bold text-ink">Танзанийский кофе: путешествие в сердце Африки</h3>
                    <p class="mt-2 line-clamp-2 text-body">Рассказываем, чем уникален кофе из Танзании и почему его стоит попробовать.</p>
                    <a href="/blog/tanzaniyskiy-kofe" class="mt-4 inline-block text-sm font-semibold text-ink transition-colors hover:text-accent">Читать далее →</a>
                </div>
            </article>
            <article class="flex flex-col overflow-hidden rounded-card border border-line bg-white shadow-card">
                <span class="grid aspect-[16/7] place-items-center bg-soft text-[#cfcfcf]">
                    <svg class="h-14 w-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                </span>
                <div class="p-6">
                    <span class="text-sm text-muted">28.08.2026</span>
                    <h3 class="mt-2 text-xl font-bold text-ink">Как правильно хранить кофе дома</h3>
                    <p class="mt-2 line-clamp-2 text-body">Простые правила, которые помогут сохранить аромат и вкус зёрен надолго.</p>
                    <a href="/blog/kak-hranit-kofe" class="mt-4 inline-block text-sm font-semibold text-ink transition-colors hover:text-accent">Читать далее →</a>
                </div>
            </article>
        </div>
    </section>

    {{-- ============ 7. МЫ В INSTAGRAM ============ --}}
    <section class="wrap pb-16">
        <h2 class="section-title">Мы в Instagram</h2>
        <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">
            <span class="grid aspect-square place-items-center rounded-card bg-soft text-[#cfcfcf]">
                <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1"></circle></svg>
            </span>
            <span class="grid aspect-square place-items-center rounded-card bg-soft text-[#cfcfcf]">
                <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1"></circle></svg>
            </span>
            <span class="grid aspect-square place-items-center rounded-card bg-soft text-[#cfcfcf]">
                <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1"></circle></svg>
            </span>
            <span class="grid aspect-square place-items-center rounded-card bg-soft text-[#cfcfcf]">
                <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1"></circle></svg>
            </span>
        </div>
    </section>
@endsection
