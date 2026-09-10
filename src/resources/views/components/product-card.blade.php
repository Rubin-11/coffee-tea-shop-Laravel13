{{--
    Карточка товара (статичный демо-вариант).
    Сейчас данные захардкожены, чтобы шаблон отображался без БД.
    Когда подключите БД — оберните карточку в @foreach и подставьте поля,
    например: {{ $product->name }}, {{ $product->price }} и т.д.
--}}
<article class="group flex flex-col overflow-hidden rounded-card border border-line bg-white shadow-card transition-shadow duration-300 hover:shadow-card-hover">
    <a href="/product/colombia-supremo" class="relative block aspect-square overflow-hidden bg-soft">
        <span class="absolute left-3 top-3 z-10 rounded-full bg-accent px-3 py-1 text-xs font-bold text-white">Скидки −15%</span>
        <span class="flex h-full w-full items-center justify-center text-[#cfcfcf]">
            <svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="3"></rect>
                <circle cx="9" cy="9" r="2"></circle>
                <path d="m21 15-5-5L5 21"></path>
            </svg>
        </span>
    </a>

    <div class="flex flex-1 flex-col p-5">
        <h3 class="text-lg font-bold leading-snug text-ink">
            <a href="/product/colombia-supremo" class="transition-colors hover:text-accent">Colombia Supremo</a>
        </h3>
        <p class="mt-2 line-clamp-2 text-sm text-body">Плотный кофе с нотами тёмного шоколада, орехов и карамели. Средняя обжарка.</p>

        <div class="mt-3 flex items-center gap-2 text-sm">
            <span class="tracking-tight text-accent" aria-hidden="true">★★★★☆</span>
            <span class="font-semibold text-ink">4.0</span>
            <span class="text-muted">(32 отзыва)</span>
        </div>

        <div class="mt-4 flex items-center justify-between gap-3 pt-1">
            <div class="flex items-baseline gap-2">
                <span class="text-sm text-muted line-through">1 200 ₽</span>
                <span class="text-xl font-extrabold text-ink">1 020 ₽</span>
            </div>
            <button type="button" class="btn-accent px-4 py-2.5 text-sm">В корзину</button>
        </div>
    </div>
</article>
