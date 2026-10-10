{{-- Пагинация (статичный демо-вариант) --}}
@if ($paginator->hasPages())
    <nav class="mt-10 flex items-center justify-center gap-2" aria-label="Пагинация">
        {{-- Предыдущая страница --}}
        @if ($paginator->onFirstPage())
        <span class="grid h-11 min-w-11 place-items-center rounded-btn bg-soft px-3 text-sm font-medium text-muted">← Назад</span>
            @else
            <a href="{{$paginator->previousPageUrl()}}"
               class="grid h-11 min-w-11 place-items-center rounded-btn border border-line bg-white px-3 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">← Назад</a>
        @endif

        {{-- Номера страниц / многоточия --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="grid h-11 min-w-11 place-items-center px-2 text-muted">{{ $element }}</span>
            @else
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="grid h-11 min-w-11 place-items-center rounded-btn bg-accent px-3 text-sm font-bold text-white shadow-card">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           class="grid h-11 min-w-11 place-items-center rounded-btn border border-line bg-white px-3 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Следующая страница --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="grid h-11 min-w-11 place-items-center rounded-btn border border-line bg-white px-3 text-sm font-medium text-body transition-colors hover:border-accent hover:text-accent">Вперёд
                →</a>
        @else
            <span class="grid h-11 min-w-11 place-items-center rounded-btn bg-soft px-3 text-sm font-medium text-muted">Вперёд →</span>
        @endif
    </nav>
@endif
