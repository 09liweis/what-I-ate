<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('product.list')->with('products', $products);
    }
    
    public function create() {
        return view('product.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:6',
                'description' => 'required',
                'price' => 'required'
            ]
        );
        
        //Cd::create($request->all());
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return redirect('products');
    }
}
