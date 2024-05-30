<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import product model 
use App\Models\Product;
use App\Models\Type;
//import inertia
use Inertia\Inertia;
class ProductsController extends Controller
{
    public function index(){
        $products = Product::latest()->limit(9)->get();
        $latest = Product::latest()->limit(3)->get();

        return Inertia::render('Welcome', [
            'products' => $products,
            'latest' => $latest 
        ]);
    }
    public function show(){
        $products = Product::with(['type', 'theme'])->paginate(12);
        $types = Type::all();

    
        return Inertia::render('Products', [
            'products' => $products,
            'types' => $types
        ]);
    }


    public function product(Request $request, $id){
        $product = Product::where('id', $id)->first();
        
        return Inertia::render('Product', [
            'product' => $product,
        ]);
    }

    public function showSearch(){
        return Inertia::render('Search');
    }

    public function search(Request $request){

        $query = Product::query();

     
        if($request->filled('name')) {
            $name = '%' . $request->input('location') . '%';
            $query->where('name', 'LIKE', $name);
        }
        $products = $query->get();

       

        return Inertia::render('SearchResult', [
            'Products' => $products,
            'formData' => $request->all(), 
        ]);

    }

    public function filter(Request $request){
        $query = Product::query();

        if ($request->has('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }

        $products = $query->paginate(12);

        return Inertia('Products', [
            'products' => $products,
        ]);
    
    }
    
}
