{{-- Информационная страница: Контакты (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Контакты — Coffee-Tea Shop')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Контакты</h1>

        <div class="mt-8 grid gap-8 lg:grid-cols-2">
            <div class="space-y-6">
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-lg font-bold text-ink">Телефоны</h2>
                    <a href="tel:+74012375343" class="mt-3 block text-body transition-colors hover:text-accent">+7 (401) 237-53-43</a>
                    <a href="tel:+79991234567" class="mt-1 block text-body transition-colors hover:text-accent">+7 (999) 123-45-67</a>
                </div>
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-lg font-bold text-ink">Почта</h2>
                    <a href="mailto:Import@kldrefine.com" class="mt-3 block text-body transition-colors hover:text-accent">Import@kldrefine.com</a>
                </div>
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-lg font-bold text-ink">Наши магазины</h2>
                    <ul class="mt-3 space-y-3 text-body">
                        <li>Калининградская обл., Гурьевский р-н, пос. Васильково</li>
                        <li>г. Калининград, ул. Кофейная, 1</li>
                    </ul>
                </div>
            </div>

            {{-- Карта (замените src на свой iframe Яндекс.Карт) --}}
            <div class="grid min-h-[420px] place-items-center overflow-hidden rounded-card border border-line bg-soft text-muted shadow-card">
                <span class="text-center">
                    <svg class="mx-auto h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span class="mt-3 block text-sm">Здесь будет карта (Яндекс.Карты)</span>
                </span>
            </div>
        </div>
    </div>
@endsection
