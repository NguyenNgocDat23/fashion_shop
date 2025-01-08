<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin');
    }
    public function viewCart(Request $request){
        $user = $request->user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $totalAmountShoppingCart = Cart::totalAmountShoppingCart($user->id);
        return view('.frontend.pages.cart', compact('cartItems','totalAmountShoppingCart'));
    } 
    public function addToCart(Request $request, $product_id){
        $user_id = $request->user()->id;
        $product = Product::find($product_id);
        if (!$product) {
            return redirect()->back();
            //return response()->json(['error' => 'Product not found'], 404);
        }
        // kịm tra sp có chưa
        $cartItem = Cart::where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => 1,
            ]);
        };
        return redirect()->route('cart.index');
    }
    public function deleteCartItem($item_id){
        $cartItem = Cart::find($item_id);
        if (!$cartItem) {
            return redirect()->back();
        }
        $cartItem->delete();
        return redirect()->route('cart.index');
    }
}
