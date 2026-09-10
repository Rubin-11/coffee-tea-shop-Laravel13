{{-- Успешное оформление заказа (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Заказ оформлен')

@section('content')
    <div class="wrap py-16">
        <div class="mx-auto max-w-xl rounded-card border border-line bg-white p-10 text-center shadow-card">
            <span class="mx-auto grid h-20 w-20 place-items-center rounded-full bg-accent-soft text-accent-dark">
                <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 13 4 4L19 7"></path></svg>
            </span>
            <h1 class="mt-6 text-[30px] font-extrabold text-ink">Спасибо за заказ!</h1>
            <p class="mt-3 text-body">Номер вашего заказа — <span class="font-bold text-ink">№ 10245</span>. Мы отправили подтверждение на вашу почту.</p>

            <dl class="mt-8 space-y-3 rounded-btn bg-soft p-5 text-left text-sm">
                <div class="flex justify-between"><dt class="text-muted">Способ доставки</dt><dd class="font-semibold text-ink">Курьером по городу</dd></div>
                <div class="flex justify-between"><dt class="text-muted">Оплата</dt><dd class="font-semibold text-ink">Картой онлайн</dd></div>
                <div class="flex justify-between"><dt class="text-muted">Сумма</dt><dd class="font-semibold text-ink">4 720 ₽</dd></div>
            </dl>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="/account/orders" class="btn-accent px-7 py-3.5">Мои заказы</a>
                <a href="/catalog" class="btn-outline px-7 py-3.5">Вернуться в каталог</a>
            </div>
        </div>
    </div>
@endsection
