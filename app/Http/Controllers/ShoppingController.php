<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Recipe;
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
        /*
        SELECT `shoppings`.`product_id`, `products`.`id`, `products`.`name`, `products`.`quantity`
        FROM `products`, `shoppings`
        WHERE (`shoppings`.`product_id` = `products`.`id`)
        AND (`shoppings`.`user_id` = '1')
         */
        $products =Shopping::from('shoppings as s')
                ->join('products as p', 'p.id', '=', 's.product_id')
                ->select('p.*')
                ->where('p.user_id', Auth::user()->id)
                ->get();

        return view('shopping/listShopping', compact('products'));
    }

    public function addShopping(Request $request)
    {
        $param = $request->except('_token');

        Shopping::create($param);

        return redirect()->route('listProduct')->with('success', __('Product has been add too shopping !'));
    }

    public function addRecipeShopping(Request $request)
    {
        $param = $request->except('_token');

        $recipes = Recipe::where('name_recipe_id', $param['idR'])->get();

        foreach ($recipes as $recipe) {
            Shopping::create([
                'product_id'=>$recipe->product_id,
                'user_id'=>$param['idU']
            ]);
        }

        return redirect()->route('listRecipe')->with('success', __('Product has been add too shopping !'));
    }

    public function deleteShopping(Request $request)
    {
        $shopping = Shopping::where('product_id', $request['product_id'])->first();
        $shopping->delete();
        return redirect()->route('listShopping')->with('success', __('Product has been remove to shopping list !'));
    }
}
