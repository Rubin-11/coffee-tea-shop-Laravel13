{{-- Корзина гостя. Данные из сессии, название и цена — из products на момент открытия --}}
@extends('layouts.main-layout')

@section('title', 'Корзина')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Корзина</h1>

        @if($errors->any())
            <div class="mt-6 rounded-btn border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach($errors->unique() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($items->isEmpty())
            <div class="mt-12 rounded-card border border-dashed border-line bg-white p-12 text-center">
                <p class="text-lg font-bold text-ink">В корзине пока пусто</p>
                <p class="mt-2 text-body">Добавьте товары из каталога — они появятся здесь.</p>
                <a href="{{ route('home') }}" class="btn-accent mt-6 px-8 py-3.5">Перейти в каталог</a>
            </div>
        @else
            <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_360px]">
                <div class="space-y-4">
                    @foreach($items as $item)
                        <div class="flex flex-col gap-4 rounded-card border border-line bg-white p-5 shadow-card sm:flex-row sm:items-center">
                            <span class="grid h-24 w-24 shrink-0 place-items-center rounded-btn bg-soft text-[#cfcfcf]">
                                <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-5-5L5 21"></path></svg>
                            </span>
                            <div class="flex-1">
                                <h3 class="font-bold text-ink">{{ $item->product->name }}</h3>
                                <p class="text-sm text-muted">{{ $item->product->price }} ₽ за шт.</p>
                            </div>
                            <div class="flex items-center rounded-btn border border-line">
                                <form method="POST" action="{{ route('cart.update', $item->product) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                    <button type="submit" class="px-3 py-2 text-muted hover:text-ink" aria-label="Уменьшить">−</button>
                                </form>
                                <span class="w-9 text-center font-semibold text-ink">{{ $item->quantity }}</span>
                                <form method="POST" action="{{ route('cart.update', $item->product) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" class="px-3 py-2 text-muted hover:text-ink" aria-label="Увеличить">+</button>
                                </form>
                            </div>
                            <div class="w-28 text-right text-lg font-extrabold text-ink">{{ number_format($item->lineTotal, 2, '.', ' ') }} ₽</div>
                            <form method="POST" action="{{ route('cart.destroy', $item->product) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" aria-label="Удалить" class="text-muted transition-colors hover:text-red-500">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14"></path></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <aside class="lg:sticky lg:top-24 lg:self-start">
                    <div class="rounded-card border border-line bg-white p-6 shadow-card">
                        <h2 class="text-xl font-bold text-ink">Итого</h2>
                        <dl class="mt-5 space-y-3 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-muted">Товары ({{ $count }})</dt>
                                <dd class="font-semibold text-ink">{{ number_format($total, 2, '.', ' ') }} ₽</dd>
                            </div>
                        </dl>

                        <div class="mt-5 flex items-baseline justify-between border-t border-line pt-5">
                            <span class="text-body">К оплате</span>
                            <span class="text-2xl font-extrabold text-ink">{{ number_format($total, 2, '.', ' ') }} ₽</span>
                        </div>

                        <a href="/checkout" class="btn-accent mt-5 w-full py-4">Оформить заказ</a>
                        <a href="{{ route('home') }}" class="mt-3 block text-center text-sm font-semibold text-ink transition-colors hover:text-accent">Продолжить покупки</a>
                    </div>
                </aside>
            </div>
        @endif
    </div>
@endsection
