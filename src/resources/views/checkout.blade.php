{{-- Оформление заказа (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Оформление заказа')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Оформление заказа</h1>

        <form class="mt-8 grid gap-8 lg:grid-cols-[1fr_380px]">
            <div class="space-y-6">
                {{-- Контактные данные --}}
                <section class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Контактные данные</h2>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Имя и фамилия *</span><input type="text" class="field" placeholder="Иван Иванов"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Телефон *</span><input type="tel" class="field" placeholder="+7 (___) ___-__-__"></label>
                        <label class="block sm:col-span-2"><span class="mb-1.5 block text-sm text-muted">Email *</span><input type="email" class="field" placeholder="you@example.com"></label>
                    </div>
                </section>

                {{-- Доставка --}}
                <section class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Доставка</h2>

                    <div class="mt-5 space-y-3">
                        <label class="flex cursor-pointer items-center gap-3 rounded-btn border border-accent bg-accent-soft px-4 py-3">
                            <input type="radio" name="delivery" class="accent-accent" checked>
                            <span class="flex-1 text-sm font-semibold text-ink">Курьером по городу</span>
                            <span class="text-sm text-muted">300 ₽</span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-3 rounded-btn border border-line px-4 py-3">
                            <input type="radio" name="delivery" class="accent-accent">
                            <span class="flex-1 text-sm font-semibold text-body">Самовывоз</span>
                            <span class="text-sm text-muted">бесплатно</span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-3 rounded-btn border border-line px-4 py-3">
                            <input type="radio" name="delivery" class="accent-accent">
                            <span class="flex-1 text-sm font-semibold text-body">Почтой России</span>
                            <span class="text-sm text-muted">от 250 ₽</span>
                        </label>
                    </div>

                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Город *</span><input type="text" class="field" placeholder="Калининград"></label>
                        <label class="block"><span class="mb-1.5 block text-sm text-muted">Улица, дом, кв. *</span><input type="text" class="field" placeholder="ул. Кофейная, 1"></label>
                    </div>
                </section>

                {{-- Оплата --}}
                <section class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Оплата</h2>
                    <div class="mt-5 space-y-3">
                        <label class="flex cursor-pointer items-center gap-3 rounded-btn border border-accent bg-accent-soft px-4 py-3">
                            <input type="radio" name="payment" class="accent-accent" checked>
                            <span class="text-sm font-semibold text-ink">Картой онлайн</span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-3 rounded-btn border border-line px-4 py-3">
                            <input type="radio" name="payment" class="accent-accent">
                            <span class="text-sm font-semibold text-body">При получении</span>
                        </label>
                    </div>

                    <label class="mt-5 block"><span class="mb-1.5 block text-sm text-muted">Комментарий к заказу</span><textarea rows="3" class="field" placeholder="Например: позвонить за час до доставки"></textarea></label>

                    <label class="mt-4 flex items-start gap-2 text-[13px] text-muted">
                        <input type="checkbox" class="mt-0.5 h-4 w-4 shrink-0 accent-accent" checked>
                        <span>Согласен(на) с условиями обработки персональных данных и <a href="/pages/privacy" class="underline hover:text-accent">политикой конфиденциальности</a></span>
                    </label>
                </section>
            </div>

            {{-- Итог заказа --}}
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <h2 class="text-xl font-bold text-ink">Ваш заказ</h2>

                    <div class="mt-5 space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="grid h-14 w-14 shrink-0 place-items-center rounded-btn bg-soft text-[#cfcfcf]">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                            </span>
                            <div class="flex-1 text-sm"><div class="font-semibold text-ink">Colombia Supremo</div><div class="text-muted">250 г × 1</div></div>
                            <div class="text-sm font-bold text-ink">1 020 ₽</div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="grid h-14 w-14 shrink-0 place-items-center rounded-btn bg-soft text-[#cfcfcf]">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"></rect></svg>
                            </span>
                            <div class="flex-1 text-sm"><div class="font-semibold text-ink">Ethiopia Yirgacheffe</div><div class="text-muted">1000 г × 2</div></div>
                            <div class="text-sm font-bold text-ink">3 400 ₽</div>
                        </div>
                    </div>

                    <dl class="mt-5 space-y-3 border-t border-line pt-5 text-sm">
                        <div class="flex justify-between"><dt class="text-muted">Товары</dt><dd class="font-semibold text-ink">4 420 ₽</dd></div>
                        <div class="flex justify-between"><dt class="text-muted">Доставка</dt><dd class="font-semibold text-ink">300 ₽</dd></div>
                        <div class="flex items-baseline justify-between pt-2 text-base"><dt class="text-body">Итого</dt><dd class="text-2xl font-extrabold text-ink">4 720 ₽</dd></div>
                    </dl>

                    <button type="submit" class="btn-accent mt-5 w-full py-4">Подтвердить заказ</button>
                </div>
            </aside>
        </form>
    </div>
@endsection
