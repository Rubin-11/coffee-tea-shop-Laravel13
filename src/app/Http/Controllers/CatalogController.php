<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\CatalogFilterRequest;
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
            ));

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

    // Фильтрация товаров в категориях
    public function show(string $slug, Request $request)
    {

    }
}
