{{-- Информационная страница: О компании (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'О компании — Coffee-Tea Shop')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap max-w-4xl pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">О компании</h1>
        <div class="mt-6 space-y-4 text-[17px] leading-relaxed text-body">
            <p>Coffee-Tea Shop — интернет-магазин свежеобжаренного кофе и премиального чая. Мы обжариваем кофе сами, в Калининграде, небольшими партиями и сразу после заказа.</p>
            <p>Наша цель — сделать качественный кофе доступным: прямые поставки с плантаций, собственная обжарка и честные цены без лишних наценок.</p>
        </div>

        <div class="mt-10 grid gap-6 sm:grid-cols-3">
            <div class="rounded-card border border-line bg-white p-6 text-center shadow-card">
                <div class="text-3xl font-extrabold text-ink">12 лет</div><div class="mt-1 text-body">на рынке</div>
            </div>
            <div class="rounded-card border border-line bg-white p-6 text-center shadow-card">
                <div class="text-3xl font-extrabold text-ink">40+</div><div class="mt-1 text-body">сортов кофе и чая</div>
            </div>
            <div class="rounded-card border border-line bg-white p-6 text-center shadow-card">
                <div class="text-3xl font-extrabold text-ink">85 000</div><div class="mt-1 text-body">довольных клиентов</div>
            </div>
        </div>

        <h2 class="mt-12 text-2xl font-extrabold text-ink">Наши ценности</h2>
        <ul class="mt-4 space-y-3 text-body">
            <li class="flex gap-3"><span class="text-accent-dark">•</span> Качество: только отборное зерно и строгий контроль обжарки.</li>
            <li class="flex gap-3"><span class="text-accent-dark">•</span> Честность: прозрачные цены и состав.</li>
            <li class="flex gap-3"><span class="text-accent-dark">•</span> Забота: поможем подобрать сорт под ваш вкус.</li>
        </ul>
    </div>
@endsection
