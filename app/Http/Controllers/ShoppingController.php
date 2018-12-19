<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Recipe;
use CommiCasa\Product;
use CommiCasa\Shopping;
use Auth;

class ShoppingController extends Controller
{
    /**
     * Create a new ShoppingController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the list of product in shopping list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listShopping()
    {
        $products =Shopping::from('shoppings as s')
                ->join('products as p', 'p.id', '=', 's.product_id')
                ->select('p.*', 's.quantity_wanted')
                ->where('p.user_id', Auth::user()->id)
                ->get();

        return view('shopping/listShopping', compact('products'));
    }

    /**
     * Add a product in shopping list and redirect to the view listProduct
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addShopping(Request $request)
    {
        $param = $request->except('_token');

        Shopping::create($param);

        return redirect()->route('listProduct')->with('success add', 'The product has been added to the shopping list');
    }

    /**
     * Add a recipe to the shopping list.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addRecipeShopping(Request $request)
    {
        $param = $request->except('_token');

        $recipes = Recipe::where('name_recipe_id', $param['idR'])->get();

        foreach ($recipes as $recipe) {
            $shopID = Shopping::where('product_id', $recipe->product_id)->first();
            $productID = Product::find($recipe->product_id);
            if (!isset($shopID)) {
                Shopping::create([
                        'product_id'=>$recipe->product_id,
                        'user_id'=>$param['idU'],
                        'quantity_wanted'=>$recipe->quantity_required + $productID->alert
                    ]);
            } else {
                $shopID->quantity_wanted += $recipe->quantity_required;
                $shopID->update();
            }
        }

        return redirect()->route('listRecipe')->with('success add', 'The recipe ingredients has been added to the shopping list');
    }

    /**
     * Delete a product bz from the shopping list
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteShopping(Request $request)
    {
        $shopping = Shopping::where('product_id', $request['product_id'])->first();
        $shopping->delete();
        return redirect()->route('listShopping')->with('success delete', 'The product has been removed from the shopping list');
    }
}
