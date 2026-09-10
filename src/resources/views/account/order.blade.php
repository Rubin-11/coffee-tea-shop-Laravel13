{{-- Личный кабинет: детали заказа (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Заказ № 10245')

@section('content')
    <div class="wrap py-10">
        <a href="/account/orders" class="text-sm font-semibold text-body transition-colors hover:text-accent">← Ко всем заказам</a>
        <h1 class="mt-3 text-[34px] font-extrabold text-ink sm:text-[42px]">Заказ № 10245</h1>
        <p class="mt-2 text-body">Оформлен 10.09.2026 · <span class="font-semibold text-accent-dark">В обработке</span></p>

        <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_340px]">
            <div class="space-y-4">
                <div class="flex items-center gap-4 rounded-card border border-line bg-white p-5 shadow-card">
                    <span class="grid h-20 w-20 shrink-0 place-items-center rounded-btn bg-soft text-[#cfcfcf]">
                        <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                    </span>
                    <div class="flex-1"><div class="font-bold text-ink">Colombia Supremo</div><div class="text-sm text-muted">250 г × 1</div></div>
                    <div class="font-bold text-ink">1 020 ₽</div>
                </div>
                <div class="flex items-center gap-4 rounded-card border border-line bg-white p-5 shadow-card">
                    <span class="grid h-20 w-20 shrink-0 place-items-center rounded-btn bg-soft text-[#cfcfcf]">
                        <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                    </span>
                    <div class="flex-1"><div class="font-bold text-ink">Ethiopia Yirgacheffe</div><div class="text-sm text-muted">1000 г × 2</div></div>
                    <div class="font-bold text-ink">3 400 ₽</div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-lg font-bold text-ink">Доставка</h2>
                    <p class="mt-3 text-sm text-body">Курьером по городу<br>г. Калининград, ул. Кофейная, 1<br>Иван Иванов, +7 (999) 123-45-67</p>
                </div>
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-lg font-bold text-ink">Оплата</h2>
                    <dl class="mt-4 space-y-3 text-sm">
                        <div class="flex justify-between"><dt class="text-muted">Товары</dt><dd class="font-semibold text-ink">4 420 ₽</dd></div>
                        <div class="flex justify-between"><dt class="text-muted">Доставка</dt><dd class="font-semibold text-ink">300 ₽</dd></div>
                        <div class="flex items-baseline justify-between border-t border-line pt-3"><dt>Итого</dt><dd class="text-xl font-extrabold text-ink">4 720 ₽</dd></div>
                    </dl>
                </div>
                <button type="button" class="btn-outline w-full py-3.5">Отменить заказ</button>
            </aside>
        </div>
    </div>
@endsection
