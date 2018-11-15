<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listProduct()
    {
        return view('product/listProduct');
    }

    public function addProduct()
    {
        return view('product/addProduct');
    }

    public function validProduct(Request $request)
    {
        $param = $request->except('_token');
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

    public function backWithMessage($type, $message)
    {
        return back()->with($type, $message);
    }

}
