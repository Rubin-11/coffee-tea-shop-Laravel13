{{-- Информационная страница: Возврат (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Возврат и обмен — Coffee-Tea Shop')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap max-w-4xl pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Возврат и обмен</h1>
        <div class="mt-6 space-y-4 text-[17px] leading-relaxed text-body">
            <p>Вы можете вернуть или обменять товар в течение 14 дней с момента получения, если он не был вскрыт и сохранил товарный вид.</p>
            <p>Для оформления возврата напишите нам на почту или позвоните — мы поможем.</p>
        </div>
        <a href="/pages/contacts" class="btn-accent mt-8 px-7 py-3.5">Связаться с нами</a>
    </div>
@endsection
