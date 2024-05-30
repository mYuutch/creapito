<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    function show(){
      
            $user = auth()->user();
            $orders = Order::where('user_id', $user->id)->get();
           
         

            return Inertia::render('Orders', [
                'orders' => $orders,
            ]);
    }

    public function order(Request $request, $id)
    {
        // Retrieve the order by id and eagerly load the related items and their products
        $order = Order::with(['items.product'])->find($id);
    
        // Debugging to check the order, items, and products
     
        // Render the order using Inertia, passing the order data
        return Inertia::render('Order', [
            'order' => $order,
        ]);
    }
    
    
}
