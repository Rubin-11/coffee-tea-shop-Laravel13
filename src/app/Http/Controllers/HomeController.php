<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        //Получить родительские категории товаров
        $categories = Category::whereNull('parent_id')->get();

        return view('home', compact(
            'categories'
        ));
    }
}
