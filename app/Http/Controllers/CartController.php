<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart (Request $request) {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer'
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => $request->customer_id]
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $request->product_id)
                            ->first();

        $product = Product::findOrFail($request->product_id);

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        }else {
            $cartItem = CartItem::create([
                'cart_id'        => $cart->id,
                'product_id'     => $product->id,
                'quantity'       => $request->quantity,
                'price_at_time'  => $product->price
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product ditambah ke keranjang!'
        ]);
    }

    public function getCartData() {

        $customerId = auth()->user()->id;

        $cart = Cart::where('user_id', $customerId)
        ->with('items.product')
        ->first();

        return response()->json([
            'cart' => $cart
        ]);
    }
}
