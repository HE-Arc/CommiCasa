<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Product;
use CommiCasa\Shopping;
use Auth;

class ShoppingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listShopping()
    {
        $shoppings = Shopping::where('user_id', Auth::user()->id);
        //$products = Product::where('id', $shoppings->product_id);
        $products = Product::All();
        return view('shopping/listShopping', compact('products'));
    }

    public function addShopping(Request $request)
    {
        $param = $request->except('_token');

        Shopping::create($param);

        return redirect()->route('listProduct')->with('success', __('Product has been add too shopping !'));
    }
}
