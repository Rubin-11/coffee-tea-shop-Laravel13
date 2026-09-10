{{-- Подвал: блок подписки + колонки ссылок + нижняя полоса --}}
<footer class="mt-20 bg-white">
    {{-- Блок подписки на новости и рассылку --}}
    <section class="bg-accent-soft">
        <div class="wrap grid items-center gap-8 py-12 lg:grid-cols-2">
            <div>
                <h2 class="text-[26px] font-extrabold text-ink sm:text-[32px]">Подписка на новости и рассылку</h2>
                <p class="mt-2 max-w-md text-body">Узнавайте первыми о новых поступлениях, скидках и акциях.</p>
            </div>
            <form action="/newsletter" method="POST">
                <div class="flex flex-col gap-3 sm:flex-row">
                    <input type="email" name="email" placeholder="Ваш email" class="field h-[52px] flex-1 rounded-full">
                    <button type="submit" class="btn-accent h-[52px] rounded-full px-8">Подписаться</button>
                </div>
                <label class="mt-3 flex items-start gap-2 text-[13px] text-muted">
                    <input type="checkbox" name="agree" class="mt-0.5 h-4 w-4 shrink-0 accent-accent">
                    <span>Согласен(на) на обработку персональных данных и <a href="/pages/privacy" class="underline hover:text-accent">политикой конфиденциальности</a></span>
                </label>
            </form>
        </div>
    </section>

    {{-- Колонки --}}
    <div class="wrap grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <div class="text-xl font-extrabold text-ink">Coffee-Tea <span class="text-accent">Shop</span></div>
            <p class="mt-4 max-w-xs text-sm leading-relaxed text-body">
                Интернет-магазин свежеобжаренного кофе и премиального чая. Обжариваем сами и доставляем по всей России.
            </p>
        </div>

        <div>
            <div class="mb-4 text-sm font-bold uppercase tracking-wide text-muted">Каталог</div>
            <ul class="space-y-3 text-sm">
                <li><a href="/catalog" class="text-body transition-colors hover:text-accent">Каталог товаров</a></li>
                <li><a href="/catalog?discount=1" class="text-body transition-colors hover:text-accent">Товары со скидкой</a></li>
            </ul>
        </div>

        <div>
            <div class="mb-4 text-sm font-bold uppercase tracking-wide text-muted">Компания</div>
            <ul class="space-y-3 text-sm">
                <li><a href="/blog" class="text-body transition-colors hover:text-accent">Блог</a></li>
                <li><a href="/pages/about" class="text-body transition-colors hover:text-accent">О компании</a></li>
                <li><a href="/pages/contacts" class="text-body transition-colors hover:text-accent">Контакты</a></li>
                <li><a href="/pages/delivery" class="text-body transition-colors hover:text-accent">Доставка и оплата</a></li>
            </ul>
        </div>

        <div>
            <div class="mb-4 text-sm font-bold uppercase tracking-wide text-muted">Контакты</div>
            <ul class="space-y-3 text-sm text-body">
                <li><a href="tel:+74012375343" class="transition-colors hover:text-accent">+7 (401) 237-53-43</a></li>
                <li><a href="mailto:Import@kldrefine.com" class="transition-colors hover:text-accent">Import@kldrefine.com</a></li>
                <li>Калининградская обл., Гурьевский р-н, пос. Васильково</li>
            </ul>
        </div>
    </div>

    {{-- Нижняя полоса --}}
    <div class="border-t border-line">
        <div class="wrap flex flex-col items-center justify-between gap-2 py-6 text-sm text-muted sm:flex-row">
            <span>&copy; 2026 Coffee-Tea Shop</span>
            <span>Свежеобжаренный кофе и премиальный чай</span>
        </div>
    </div>
</footer>
