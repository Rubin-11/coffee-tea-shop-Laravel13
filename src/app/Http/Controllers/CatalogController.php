<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(string $slug)
    {
        $properties = Property::get();

//        return $properties;

        // Найти категорию по slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Получить id всех дочерних категорий
        $childCategories = Category::where('parent_id', $category->id)->get();

        // Получить все товары, соответствующей категории.
        $products = Product::with('category')
            ->whereIn('category_id', $childCategories->pluck('id')->push($category->id))
            ->paginate(8);

//        return $products;

        return view('components.pages.catalog', compact(
            'products',
            'slug',
            'childCategories'
        ));
    }

    // Фильтрация товаров в категориях
    public function show(string $slug, Request $request)
    {

    }
}
