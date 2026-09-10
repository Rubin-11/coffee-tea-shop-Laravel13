<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">

    @switch ($slug)
        @case ('svezheobzharennyy-kofe')
            <!-- Заголовок -->
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                Сортировка кофе
            </h3>
            <h4 class="text-sm font-medium text-gray-700 mb-3">География</h4>
            @break
        @case ('chay-i-kofejnye-napitki')
            <!-- Заголовок -->
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                Сортировка чая и кофейных напитков
            </h3>
            @break
        @case ('produktsiya-vendinga')
            <!-- Заголовок -->
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                Сортировка продукции вендинга
            </h3>
            @break
        @case ('zdorovoe-pitanie')
            <!-- Заголовок -->
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                Сортировка здорового питания
            </h3>
            @break
    @endswitch

    <div class="mb-6">
        <div class="flex flex-wrap gap-3">
            @foreach($categories as $category)
                <label class="inline-flex items-center">
                    <input type="checkbox"
                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">{{$category->name}}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>
