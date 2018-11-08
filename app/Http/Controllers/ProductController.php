<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;

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
       var_dump( $request->all()); die;
    }
}
