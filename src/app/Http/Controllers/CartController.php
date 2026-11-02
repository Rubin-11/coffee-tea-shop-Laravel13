<?php

namespace App\Http\Controllers;

use App\Contracts\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Cart $cart): View
    {
        $items = $cart->items();

        return view('cart', [
            'items' => $items,
            'total' => $items->sum(fn ($item) => $item->lineTotal),
            'count' => $items->sum(fn ($item) => $item->quantity),
        ]);
    }

    public function store(StoreCartRequest $request, Cart $cart): RedirectResponse
    {
        $cart->add($request->integer('product_id'), $request->integer('quantity'));

        return back();
    }

    public function update(UpdateCartRequest $request, Product $product, Cart $cart): RedirectResponse
    {
        $cart->set($product->id, $request->integer('quantity'));

        return back();
    }

    public function destroy(Product $product, Cart $cart): RedirectResponse
    {
        $cart->remove($product->id);

        return back();
    }
}
