{{-- Результаты поиска по названию товара --}}
@extends('layouts.main-layout')

@section('title', 'Поиск — Coffee-Tea Shop')

@section('content')
    <nav class="wrap py-5 text-sm text-muted" aria-label="Хлебные крошки">
        <ol class="flex flex-wrap items-center gap-2">
            <li><a href="{{ route('home') }}" class="transition-colors hover:text-accent">Главная</a></li>
            <li class="text-line">/</li>
            <li class="text-ink">Поиск</li>
        </ol>
    </nav>

    <div class="wrap pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Поиск</h1>

        @if($errors->any())
            <div class="mt-6 rounded-btn border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach($errors->unique() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(filled(request('q')))
            <p class="mt-3 max-w-2xl text-body">Результаты по запросу «{{ request('q') }}».</p>

            <p class="mb-6 mt-8 text-sm text-muted">Найдено {{ $products->total() }} товаров</p>

            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @forelse($products as $product)
                    @include('components.product-card', ['product' => $product])
                @empty
                    <p class="text-body sm:col-span-2 xl:col-span-3">Ничего не найдено. Попробуйте другое название.</p>
                @endforelse
            </div>

            {{ $products->links('components.pagination') }}
        @else
            <p class="mt-3 max-w-2xl text-body">Введите название товара в поле поиска.</p>
        @endif
    </div>
@endsection
