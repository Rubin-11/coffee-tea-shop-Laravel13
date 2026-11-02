<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\CatalogFilterRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(CatalogFilterRequest $request, string $slug)
    {
        // Найти категорию по slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Получить id всех дочерних категорий
        $childCategories = Category::where('parent_id', $category->id)->get();

        // Главные категории — для переключателя над заголовком (как на главной)
        $categories = Category::whereNull('parent_id')->get();

        // Только проверенные параметры фильтров: сырой ввод из query string в запрос не попадает
        $filters = $request->validated();

        // Получить все товары, соответствующей категории, с учётом фильтров
        $products = Product::with('category')
            ->whereIn('category_id', $childCategories->pluck('id')->push($category->id))
            ->when(filled($filters['price_min'] ?? null), fn ($query) => $query->where('price', '>=', $filters['price_min']))
            ->when(filled($filters['price_max'] ?? null), fn ($query) => $query->where('price', '<=', $filters['price_max']))
            ->when(filled($filters['subcategory'] ?? null), fn ($query) => $query->whereIn(
                'category_id', array_map('intval', $filters['subcategory'])
            ))
            ->when(filled($filters['q'] ?? null), fn ($query) => $query->whereNameContains($filters['q']));

        // Внутри группы значения объединяются через ИЛИ, между группами — через И
        foreach (CatalogFilterRequest::PROPERTY_FILTERS as $param => $groupSlug) {
            $products->when(filled($filters[$param] ?? null), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p
                    ->whereIn('properties.value', $filters[$param])
                    ->whereHas('group', fn ($g) => $g->where('slug', $groupSlug))
            ));
        }

        $products = $products->paginate(6)->appends($request->query());

        return view('components.pages.catalog', compact(
            'products',
            'category',
            'slug',
            'childCategories',
            'categories'
        ));
    }

    // Поиск по названию по всему каталогу. Пустой запрос ничего не показывает:
    // страница поиска без слова — не список всех товаров
    public function search(SearchRequest $request)
    {
        $term = $request->validated('q');

        $products = Product::with('category')
            ->when(
                filled($term),
                fn ($query) => $query->whereNameContains($term),
                fn ($query) => $query->whereKey([])
            )
            ->paginate(6)
            ->appends($request->query());

        return view('components.pages.search', compact('products'));
    }

    // Фильтрация товаров в категориях
    public function show(string $slug, Request $request)
    {

    }
}
