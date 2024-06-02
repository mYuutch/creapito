<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Illuminate\Http\Request;
//use DB

use Stripe\Stripe;
use App\Models\Order;
use App\Models\OrderItem;

class StripeController extends Controller
{

    public function checkout()
    {
        return Inertia::render('Products', []);
    }

 

    public function test(Request $request)
    {

        
        $user = $request->user();
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = $cart->cartItems; 

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }
        
       
        Stripe::setApiKey(env('STRIPE_SECRET'));

       
        $lineItems = [];
        $totalPrice = 0;
            foreach ($cart->cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item->product->name,
                        ],
                        'unit_amount' => $item->product->price * 100,
                    ],
                    'quantity' => $item->quantity,
                ];
                
            }
        
         
            $session = Session::create([
                'mode'        => 'payment',
                'line_items'  => $lineItems,
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}', // Correctly add session ID placeholder
                'cancel_url'  => route('checkout'),
                'locale' => 'fr',
                'shipping_address_collection' => [
                    'allowed_countries' => ['FR'],
                ],
                'automatic_tax' => [
                    'enabled' => true,
                ],
            ]);

        $order = DB::transaction(function () use ($user, $totalPrice, $cartItems, $session) {
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalPrice,
                'payment_status' => 'unpaid',
                'shipping_status' => 'pending',
                'shipping_address' => 'pending',
                'session_id' => $session->id,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' =>$item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            return $order;
        });
        
        CartItem::where('user_id', $user->id)->delete();

        return Inertia::location($session->url);
    }



    public function success(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));



        $session_id = $request->query('session_id');
        if (!$session_id) {
            return redirect()->route('checkout')->with('error', 'Session ID is missing.');
        }
    
        $order = Order::where('session_id', $session_id)->first();
        if (!$order) {
            return redirect()->route('checkout')->with('error', 'Order not found.');
        }
        $session = Session::retrieve($session_id);
        
        $shippingAddress = $session->shipping_details['address'];
        $address = implode(", ", array_filter([
            $shippingAddress['line1'] ?? '',
            $shippingAddress['line2'] ?? '',
            $shippingAddress['postal_code'] ?? '',
            $shippingAddress['city'] ?? '',
            $shippingAddress['state'] ?? '',
            $shippingAddress['country'] ?? '',
        ]));
    
        // Update payment status and shipping address
        $order->update([
            'payment_status' => 'paid',
            'shipping_address' => $address,
        ]);
    
        // Update payment status
        $order->update([
            'payment_status' => 'paid',
        ]);
    
        return to_route('orders.show');
    }

}