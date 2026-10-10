{{-- Каталог категории (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Каталог — свежеобжаренный кофе')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap pb-16">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            {{-- $mainCategory, а не $category, чтобы не затереть текущую категорию после цикла --}}
            @foreach($categories as $mainCategory)
                @include('components.category-card', ['category' => $mainCategory])
            @endforeach
        </div>

        <h1 class="mt-10 text-[34px] font-extrabold text-ink sm:text-[42px]">{{$category->name}}</h1>
        <p class="mt-3 max-w-2xl text-body">Кофе из разных стран произрастания, обжаренный в Калининграде. Выберите сорт
            под свой вкус.</p>

        <div class="mt-8 grid gap-8 lg:grid-cols-[280px_1fr]">
            {{-- ===== Фильтры ===== --}}
            <aside class="space-y-6">
                <div class="rounded-card border border-line bg-white p-6 shadow-card">
                    <div class="mb-4 flex items-center justify-between">
                        <span class="text-lg font-bold text-ink">Фильтры</span>
                        <a href="{{ route('catalog', $category->slug) }}" class="text-sm text-muted transition-colors hover:text-accent">Сбросить</a>
                    </div>

                    <form method="GET">
                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Цена, ₽</div>
                        <div class="flex items-center gap-2">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="от" class="field py-2.5">
                            <span class="text-muted">—</span>
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="до" class="field py-2.5">
                        </div>
                    </div>

                    <hr class="my-5 border-line">
                    @if($category->slug === 'svezheobzharennyy-kofe')
                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Способ обжарки</div>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="processing[]" value="Сухая" class="rounded accent-accent" @checked(in_array('Сухая', (array) request('processing', [])))>
                            Сухая
                        </label>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="processing[]" value="Мытая" class="rounded accent-accent" @checked(in_array('Мытая', (array) request('processing', [])))>
                            Мытая
                        </label>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="processing[]" value="Прочие" class="rounded accent-accent" @checked(in_array('Прочие', (array) request('processing', [])))>
                            Прочие
                        </label>
                    </div>

                    <hr class="my-5 border-line">

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Степень обжарки</div>
                        <div class="flex flex-wrap gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <label
                                    class="grid h-9 w-9 cursor-pointer place-items-center rounded-btn border border-line text-sm text-body transition-colors hover:border-accent has-[:checked]:border-accent has-[:checked]:bg-accent has-[:checked]:text-white">
                                    <input type="checkbox" name="roast_level[]" value="{{ $i }}" class="sr-only" @checked(in_array($i, (array) request('roast_level', [])))>
                                    {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>

                    <hr class="my-5 border-line">

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Кислинка</div>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="acidity[]"
                                   value="Низкая"
                                   class="rounded accent-accent" @checked(in_array('Низкая', (array) request('acidity', [])))>
                            Низкая</label>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="acidity[]"
                                   value="Средняя"
                                   class="rounded accent-accent" @checked(in_array('Средняя', (array) request('acidity', [])))>
                            Средняя</label>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="acidity[]"
                                   value="Высокая"
                                   class="rounded accent-accent" @checked(in_array('Высокая', (array) request('acidity', [])))>
                            Высокая</label>
                    </div>

                    <hr class="my-5 border-line">

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Вид кофе</div>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="coffee_type[]" value="Арабика" class="rounded accent-accent" @checked(in_array('Арабика', (array) request('coffee_type', [])))>
                            Арабика
                        </label>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="coffee_type[]" value="Рабуста" class="rounded accent-accent" @checked(in_array('Рабуста', (array) request('coffee_type', [])))>
                            Рабуста
                        </label>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="coffee_type[]" value="Смесь арабики"
                                   class="rounded accent-accent" @checked(in_array('Смесь арабики', (array) request('coffee_type', [])))>
                            Смесь арабики</label>
                        <label class="flex items-center gap-2 text-body">
                            <input type="checkbox" name="coffee_type[]" value="Смесь арабика/рабуста"
                                   class="rounded accent-accent" @checked(in_array('Смесь арабика/рабуста', (array) request('coffee_type', [])))>
                            Смесь арабика/рабуста
                        </label>
                    </div>

                    <hr class="my-5 border-line">

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Насыщенность</div>
                        <div class="flex flex-wrap gap-2">
                            @for ($i = 1; $i <= 10; $i++)
                                <label
                                    class="grid h-9 w-9 cursor-pointer place-items-center rounded-btn border border-line text-sm text-body transition-colors hover:border-accent has-[:checked]:border-accent has-[:checked]:bg-accent has-[:checked]:text-white">
                                    <input type="checkbox" name="body[]" value="{{ $i }}" class="sr-only" @checked(in_array($i, (array) request('body', [])))>
                                    {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>

                    <hr class="my-5 border-line">

                    <div class="space-y-2">
                        <div class="text-sm font-bold uppercase tracking-wide text-muted">Горчинка</div>
                        <div class="flex flex-wrap gap-2">
                            @for ($i = 1; $i <= 10; $i++)
                                <label
                                    class="grid h-9 w-9 cursor-pointer place-items-center rounded-btn border border-line text-sm text-body transition-colors hover:border-accent has-[:checked]:border-accent has-[:checked]:bg-accent has-[:checked]:text-white">
                                    <input type="checkbox" name="bitterness[]" value="{{ $i }}" class="sr-only" @checked(in_array($i, (array) request('bitterness', [])))>
                                    {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>
                        @else
                        <div class="space-y-2">
                            <div class="text-sm font-bold uppercase tracking-wide text-muted">{{$category->name}}</div>
                            @foreach($childCategories as $childCategory)
                                <label class="flex items-center gap-2 text-body">
                                    <input type="checkbox" name="subcategory[]" value="{{ $childCategory->id }}" class="rounded accent-accent" @checked(in_array($childCategory->id, (array) request('subcategory', [])))>
                                    {{$childCategory->name}}
                                </label>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit" class="btn-accent mt-6 w-full">Применить</button>
                    </form>
                </div>
            </aside>

            {{-- ===== Сетка товаров ===== --}}
            <div>
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <span class="text-sm text-muted">Найдено {{ $products->total() }} товаров</span>
                    <label class="flex items-center gap-2 text-sm text-body">
                        Сортировка:
                        <select class="field py-2.5 pr-8">
                            <option>По популярности</option>
                            <option>Сначала дешёвые</option>
                            <option>Сначала дорогие</option>
                            <option>По рейтингу</option>
                        </select>
                    </label>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach($products as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
                {{ $products->links('components.pagination') }}
            </div>
        </div>
    </div>
@endsection
