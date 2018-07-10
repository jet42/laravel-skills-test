<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function store(Request $request){

        $input_product = $request->all();
        $input_product['timestamp'] = \date("Y-m-d H:i:s");
        if ($request->session()->has('products')) {
            $products = $request->session()->get('products');
        } else {
            $products = [];
        }
        $products[] = $input_product;
        $request->session()->put('products', $products);
        return $products;
    }

    public function index(Request $request)
    {
        if ($request->session()->has('products')) {
            return $request->session()->get('products');
        }
    }
}
