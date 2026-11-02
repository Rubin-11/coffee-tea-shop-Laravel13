<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use App\Services\SessionCart;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(SessionCart $cart): View
    {
        $items = $cart->items();

        return view('cart', [
            'items' => $items,
            'total' => $items->sum(fn ($item) => $item->lineTotal),
            'count' => $items->sum(fn ($item) => $item->quantity),
        ]);
    }

    public function store(StoreCartRequest $request, SessionCart $cart): RedirectResponse
    {
        $cart->add($request->integer('product_id'), $request->integer('quantity'));

        return back();
    }

    public function update(UpdateCartRequest $request, Product $product, SessionCart $cart): RedirectResponse
    {
        $cart->set($product->id, $request->integer('quantity'));

        return back();
    }

    public function destroy(Product $product, SessionCart $cart): RedirectResponse
    {
        $cart->remove($product->id);

        return back();
    }
}
