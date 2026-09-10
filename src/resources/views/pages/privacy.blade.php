{{-- Информационная страница: Политика конфиденциальности (статичный демо-шаблон) --}}
@extends('layouts.main-layout')

@section('title', 'Политика конфиденциальности — Coffee-Tea Shop')

@section('content')
    @include('components.breadcrumbs')

    <div class="wrap max-w-4xl pb-16">
        <h1 class="text-[34px] font-extrabold text-ink sm:text-[42px]">Политика конфиденциальности</h1>
        <div class="mt-6 space-y-4 text-[17px] leading-relaxed text-body">
            <p>Мы уважаем вашу приватность и обрабатываем персональные данные только для оформления заказов и связи с вами.</p>
            <p>Данные не передаются третьим лицам, кроме служб доставки, необходимых для выполнения заказа.</p>
            <p>Вы можете в любой момент запросить удаление своих данных, написав нам на почту.</p>
        </div>
    </div>
@endsection
