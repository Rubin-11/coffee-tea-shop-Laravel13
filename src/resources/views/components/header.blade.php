{{--
    Шапка сайта: логотип, навигация, поиск, иконки (ЛК, корзина).
    Мобильное меню — на чистом CSS (checkbox + peer), без JS.
--}}
<header class="sticky top-0 z-50 bg-white shadow-header">
    {{-- Скрытый чекбокс мобильного меню (должен быть первым, чтобы работал peer) --}}
    <input id="mobile-menu" type="checkbox" class="peer hidden">

    <div class="wrap flex items-center justify-between gap-4 py-4">
        {{-- Логотип --}}
        <a href="/" class="shrink-0 text-[22px] font-extrabold leading-none tracking-tight text-ink sm:text-[26px]">
            Coffee-Tea <span class="text-accent">Shop</span>
        </a>

        {{-- Навигация (десктоп) --}}
        <nav class="hidden items-center gap-9 lg:flex">
            <a href="/catalog" class="text-[17px] font-medium text-ink transition-colors hover:text-accent">Каталог товаров</a>
            <a href="/blog" class="text-[17px] font-medium text-ink transition-colors hover:text-accent">Блог</a>
            <a href="/pages/contacts" class="text-[17px] font-medium text-ink transition-colors hover:text-accent">Контакты</a>
        </nav>

        {{-- Действия --}}
        <div class="flex items-center gap-1 sm:gap-2">
            {{-- Поиск (десктоп) --}}
            <form action="/catalog" method="GET" class="mr-1 hidden md:block">
                <label class="flex h-11 items-center gap-2 rounded-full border border-line bg-white px-4">
                    <svg class="h-4 w-4 shrink-0 text-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="7"></circle><path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="search" name="q" placeholder="Поиск по товарам" class="w-44 bg-transparent text-sm text-ink outline-none placeholder:text-muted xl:w-56">
                </label>
            </form>

            {{-- Личный кабинет --}}
            <a href="/account" aria-label="Личный кабинет" title="Личный кабинет"
               class="grid h-11 w-11 place-items-center rounded-full text-ink transition-colors hover:bg-soft hover:text-accent">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>

            {{-- Корзина со счётчиком --}}
            <a href="/cart" aria-label="Корзина" title="Корзина"
               class="relative grid h-11 w-11 place-items-center rounded-full text-ink transition-colors hover:bg-soft hover:text-accent">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="absolute -right-0.5 -top-0.5 grid h-5 min-w-5 place-items-center rounded-full bg-accent px-1 text-[11px] font-bold text-white">2</span>
            </a>

            {{-- Бургер (мобильное меню) --}}
            <label for="mobile-menu" aria-label="Меню" title="Меню"
                   class="grid h-11 w-11 cursor-pointer place-items-center rounded-full text-ink transition-colors hover:bg-soft lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18M3 12h18M3 18h18"></path>
                </svg>
            </label>
        </div>
    </div>

    {{-- Мобильное меню (раскрывается чекбоксом) --}}
    <div class="hidden border-t border-line bg-white peer-checked:block">
        <nav class="wrap flex flex-col gap-1 py-4 lg:hidden">
            <a href="/catalog" class="rounded-btn px-3 py-3 text-[17px] font-medium text-ink hover:bg-soft">Каталог товаров</a>
            <a href="/blog" class="rounded-btn px-3 py-3 text-[17px] font-medium text-ink hover:bg-soft">Блог</a>
            <a href="/pages/contacts" class="rounded-btn px-3 py-3 text-[17px] font-medium text-ink hover:bg-soft">Контакты</a>
            <a href="/account" class="rounded-btn px-3 py-3 text-[17px] font-medium text-ink hover:bg-soft">Личный кабинет</a>
            <form action="/catalog" method="GET" class="mt-2">
                <input type="search" name="q" placeholder="Поиск по товарам" class="field">
            </form>
        </nav>
    </div>
</header>
