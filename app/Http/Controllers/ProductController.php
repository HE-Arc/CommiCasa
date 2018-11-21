<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Product;
use CommiCasa\User;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listProduct()
    {
        $products = Product::All();
        $users = User::All();
        return view('product/listProduct', compact('products', 'users'));
    }

    public function addProduct()
    {
        return view('product/addProduct');
    }

    public function validProduct(Request $request)
    {
        $param = $request->except('_token');
        var_dump($param); die ;
        if($param['image'] == null)
            $param['image'] = 'null';

        if($param['description'] == null)
            $param['description'] = 'null';

        if($param['regular'] == 'off')
            $param['regular'] = 0;
        else
            $param['regular'] = 1;

        //var_dump($param); die;

        Product::create($param);

        return redirect()->route('listProduct')->with('success', __('Product has been add !'));
    }

    public function updateProduct(Request $request)
    {
        $param = $request->except('_token');
        $product = Product::where('id', $param['product_id'])->first();

        if($param['quantity'] == '1')
        {
            $param['quantity'] = $product->quantity + 1;
            $product->update($param);
            return redirect()->route('listProduct')->with('success', __('Product has been add !'));
        }
        else
        {
            if(!$product->quantity <= 0)
            {
                $param['quantity'] = $product->quantity - 1;
                $product->update($param);
            }
            return redirect()->route('listProduct')->with('success', __('Product has been remove !'));
        }
    }

    public function backWithMessage($type, $message)
    {
        return back()->with($type, $message);
    }

}
