<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Product;
use CommiCasa\Shopping;

class ShoppingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listShopping()
    {
        $products = Product::All();
        $users = User::All();
        return view('shopping/listProduct', compact('products', 'users'));
    }
}
