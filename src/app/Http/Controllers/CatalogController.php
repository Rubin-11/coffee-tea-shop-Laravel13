<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
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
            ->when($request->filled('processing'), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p->where('name', 'Способ обжарки')->whereIn('value', $request->processing)
            ))
            ->when($request->filled('roast_level'), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p->where('name', 'Степень обжарки')->whereIn('value_int', $request->roast_level)
            ))
            ->when($request->filled('acidity'), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p->where('name', 'Кислинка')->whereIn('value', $request->acidity)
            ))
            ->when($request->filled('coffee_type'), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p->where('name', 'Вид кофе')->whereIn('value', $request->coffee_type)
            ))
            ->when($request->filled('body'), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p->where('name', 'Насыщенность')->whereIn('value_int', $request->body)
            ))
            ->when($request->filled('bitterness'), fn ($query) => $query->whereHas(
                'properties', fn ($p) => $p->where('name', 'Горчинка')->whereIn('value_int', $request->bitterness)
            ))
            ->when($request->filled('subcategory'), fn ($query) => $query->whereIn(
                'category_id', array_map('intval', $request->subcategory)
            ))
            ->paginate(6)
            ->appends($request->query());

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
