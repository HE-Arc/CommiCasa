<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Recipe;
use CommiCasa\ListRecipe;
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
        $listRecipes = ListRecipe::where('user_id', Auth::user()->id)->get();
        $recipes = Recipe::where('user_id', Auth::user()->id)->get();
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('recipe/listRecipe', compact('listRecipes', 'recipes', 'products'));
    }

    public function addRecipe()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
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
        $tempRequest = $request;
        $paramList = $request->except('_token', 'count', 'quant', 'prod');
        if ($paramList['image'] == null) {
            $paramList['image'] = 'null';
        }

        if ($paramList['description'] == null) {
            $paramList['description'] = 'null';
        }
        $recipeID = ListRecipe::create($paramList);




        $paramRecipe = $tempRequest->except('_token', 'count', 'name', 'description', 'image');

        #$nameID = ListRecipe::where('user_id', $paramRecipe['user_id'])->sortByDesc()->first();
        #var_dump($nameID);
        #die;

        for ($i=0;$i<count($paramRecipe['prod']);$i++) {
            Recipe::create([
                'user_id' => $paramRecipe['user_id'],
                'product_id' => $paramRecipe['prod'][$i],
                'name_recipe_id' => $recipeID->id,
                'quantity' => $paramRecipe['quant'][$i]
            ]);
        }

        return redirect()->route('listRecipe')->with('success', __('Recipe has been add !'));
    }

    public function backWithMessage($type, $message)
    {
        return back()->with($type, $message);
    }
}
