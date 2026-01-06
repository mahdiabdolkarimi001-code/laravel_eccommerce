<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'ابتدا وارد سایت شوید.');
        }

        $product = Product::findOrFail($productId);

        // قیمت نهایی با تخفیف (از اکسسور مدل Product)
        $finalPrice = $product->price_after_discount;

        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $finalPrice,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'محصول به سبد خرید اضافه شد.');
    }

    // نمایش سبد خرید
    public function index()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        return view('cart.index', compact('cartItems'));
    }

    // حذف محصول از سبد خرید
    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index');
    }
}
