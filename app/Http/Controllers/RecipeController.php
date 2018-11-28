<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Recipe;
use Auth;
use CommiCasa\Product;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listRecipe()
    {
        return view('recipe/listRecipe');
    }

    public function addRecipe()
    {
        $products = Product::all();
        $uid = Auth::user()->id;

        if ($products->count()==0) {
            return view('recipe/listRecipe')->with('error', __('Create some products first!'));
        }
        $uproducts = Product::where('user_id', $uid);
        return view('recipe/addRecipe')->with('products', $products);
    }

    public function showRecipe()
    {
        return view('recipe/showRecipe');
    }

    public function validRecipe(Request $request)
    {
        $param = $request->except('_token');
        if ($param['image'] == null) {
            $param['image'] = 'null';
        }

        if ($param['description'] == null) {
            $param['description'] = 'null';
        }

        var_dump($param);
        die;

        return redirect()->route('listRecipe')->with('success', __('Recipe has been add !'));
    }

    public function backWithMessage($type, $message)
    {
        return back()->with($type, $message);
    }
}
