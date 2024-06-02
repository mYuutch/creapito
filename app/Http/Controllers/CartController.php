<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{


    public function show(){
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->cartItems()->with('product')->get();

        
       
        return Inertia::render('Cart', [
            'cartItems' => $cartItems,
        ]);
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $product = Product::findOrFail($request->product_id);
        $user = $request->user();
    
        // Check if requested quantity is available
        if ($product->quantity < $request->quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Insufficient quantity available for this product.',
            ]);
        }
    
        // Find or create the cart
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
    
        // Find or create the cart item
        $cartItem = CartItem::firstOrNew(['cart_id' => $cart->id, 'product_id' => $product->id]);
        $cartItem->quantity += $request->quantity;
        $product->quantity -= $request->quantity;
        $product->save();
        $cartItem->save();
    
        return to_route('index');
    }



    // Remove a product from the cart
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        $user = $request->user();
        $product = Product::find($request->product_id);
    
        // Find the cart
        $cart = Cart::where('user_id', $user->id)->first();
    
        if ($cart) {
            // Find the cart item
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
    
            if ($cartItem) {
                // Decrease the quantity
                $cartItem->quantity--;
                $product->quantity++;
    
                // Check if the quantity is 0 or less
                if ($cartItem->quantity <= 0) {
                    $cartItem->delete();
                    $product->save();
                    return to_route('cart.show');
                } else {
                    $cartItem->save();
                    $product->save();
                    return to_route('cart.show');
                }
            }
        }
    
        return response()->json(['message' => 'Product not found in cart'], 404);
    }
    


    public function clear(Request $request)
    {
        $user = $request->user();

        // Find the cart
        $cart = Cart::where('user_id', $user->id)->first();

        if ($cart) {
            // Delete all cart items
            CartItem::where('cart_id', $cart->id)->delete();
            return to_route('cart.show');
        }

        return response()->json(['message' => 'Cart not found'], 404);
    }
    
}
