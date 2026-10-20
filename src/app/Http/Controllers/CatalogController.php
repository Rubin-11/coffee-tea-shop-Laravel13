<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // параметр query string => slug группы характеристик (property_groups.slug)
    private const PROPERTY_FILTERS = [
        'processing' => 'processing-method',
        'roast_level' => 'roast-level',
        'acidity' => 'acidity',
        'coffee_type' => 'coffee-type',
        'body' => 'body',
        'bitterness' => 'bitterness',
    ];

    public function index(Request $request, string $slug)
    {
        // Найти категорию по slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Получить id всех дочерних категорий
        $childCategories = Category::where('parent_id', $category->id)->get();

        // Главные категории — для переключателя над заголовком (как на главной)
        $categories = Category::whereNull('parent_id')->get();

        // Получить все товары, соответствующей категории, с учётом фильтров из query string
        $products = Product::with('category')
            ->whereIn('category_id', $childCategories->pluck('id')->push($category->id))
            ->when($request->filled('price_min'), fn ($query) => $query->where('price', '>=', $request->price_min))
            ->when($request->filled('price_max'), fn ($query) => $query->where('price', '<=', $request->price_max))
            ->when($request->filled('subcategory'), fn ($query) => $query->whereIn(
                'category_id', array_map('intval', $request->subcategory)
            ));

        // Внутри группы значения объединяются через ИЛИ, между группами — через И
        foreach (self::PROPERTY_FILTERS as $param => $groupSlug) {
            $products->when($request->filled($param), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p
                    ->whereIn('properties.value', array_map('strval', (array) $request->input($param)))
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
