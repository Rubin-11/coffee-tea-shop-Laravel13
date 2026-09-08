<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index(string $slug)
    {
        // Найти категорию по slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Получить id всех дочерних категорий
        $childCategories = Category::where('parent_id', $category->id)->get();

        // Получить все товары, соответствующей категории.
        $products = Product::with('category')
            ->whereIn('category_id', $childCategories->pluck('id')->push($category->id))
            ->paginate(8);

        return view('components.pages.catalog', compact(
            'products',
        ));
    }
}
