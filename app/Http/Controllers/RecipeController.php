<?php
namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Recipe;
use CommiCasa\ListRecipe;
use Auth;
use CommiCasa\Product;
use Illuminate\Support\Facades\File;

class RecipeController extends Controller
{
    /**
     * Create a new RecipeController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the list of recipe in the view listRecipe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listRecipe()
    {
        $listRecipes = ListRecipe::where('user_id', Auth::user()->id)->get();
        $products = Recipe::from('recipes as r')
            ->join('products as p', 'p.id', '=', 'r.product_id')
            ->select('p.*', 'r.*')
            ->where('p.user_id', Auth::user()->id)
            ->get();
        return view('recipe/listRecipe', compact('listRecipes', 'products'));
    }

    /**
     * Add a new recipe if one product exist. Otherwise redirect to the view addRecipe with error
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addRecipe()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();

        if (!isset($products)) {
            return view('recipe/listRecipe')->with('success delete', 'Create some products first!');
        }
        return view('recipe/addRecipe', compact('products'));
    }

    /**
     * Valide the add of a new recipe and create it.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validRecipe(Request $request)
    {
        $tempRequest = $request;

        $path = 'recipes/images/' . Auth::user()->id;
        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $fileName = $request['name'] . '-' . $request->file('image')->getClientOriginalName();
            $file->move($path, $fileName);
        } else {
            $fileName = "default.png";
        }
        $recipeID = new ListRecipe();
        $recipeID->name = $request['name'];
        $recipeID->user_id = Auth::user()->id;
        $recipeID->description =$request['description'];
        $recipeID->image = $fileName;
        $recipeID->save();
        $paramRecipe = $tempRequest->except('_token', 'count', 'name', 'description', 'image');
        for ($i=0;$i<count($paramRecipe['prod']);$i++) {
            Recipe::create([
                'user_id' => $paramRecipe['user_id'],
                'product_id' => $paramRecipe['prod'][$i],
                'name_recipe_id' => $recipeID->id,
                'quantity_required' => $paramRecipe['quant'][$i]
            ]);
        }
        return redirect()->route('listRecipe')->with('success add', '"' . $recipeID->name . '"' . ' has been added');
    }

    /**
     * Redirect to the view addRecipe with id recipe parameter. If the method is post also, edit the recipe given.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editRecipe(Request $request, $id)
    {
        $tempRequest = $request;
        $products = Product::where('user_id', Auth::user()->id)->get();
        $recipeList = ListRecipe::find($id);
        $recipes = Recipe::from('recipes as r')
            ->join('products as p', 'p.id', '=', 'r.product_id')
            ->select('r.*', 'p.name')
            ->where('name_recipe_id', $id)
            ->get();

        $image = $recipeList['image'];
        if ($request->isMethod('post')) {
            $path = 'recipes/images/' . Auth::user()->id;
            $file = $request->file('image');
            if ($request->hasFile('image')) {
                $fileName = $id . '-' .$request->file('image')->getClientOriginalName();
                $file->move($path, $fileName);
                $recipeList->image = $fileName;
                if ($image != "default.png") {
                    File::delete("recipes/images/". Auth::user()->id . "/" . $image);
                }
            }
            $recipeList->name = $request['name'];
            $recipeList->user_id = Auth::user()->id;
            $recipeList->description = $request['description'];
            $recipeList->save();
            $paramRecipe = $tempRequest->except('_token', 'count', 'name', 'description', 'image');
            $recipeArray = Recipe::where('name_recipe_id', $id)->get();
            if(isset($paramRecipe['prodID']))
            {
                for ($i=0;$i<count($paramRecipe['prodID']);$i++) {
                    foreach ($recipeArray as $rec) {
                        if ($rec['id']==$paramRecipe['prodID'][$i]) {
                            $rec->quantity_required = $paramRecipe['quantMod'][$i];
                            $rec->save();
                        }
                    }
                }
            }

            if ($paramRecipe['addProdOK']==1) {
                for ($i=0;$i<count($paramRecipe['prod']);$i++) {
                    Recipe::create([
                        'user_id' => $paramRecipe['user_id'],
                        'product_id' => $paramRecipe['prod'][$i],
                        'name_recipe_id' => $recipeList->id,
                        'quantity_required' => $paramRecipe['quant'][$i]
                    ]);
                }
            }

            return redirect()->route('listRecipe')->with('success add', '"'. $request['name'] . '" has been updated');
        }

        return view('recipe/addRecipe', compact('products', 'recipeList', 'recipes'))->with('success add', '"'. $request['name'] . '" has been updated');
    }

    /**
     * Delete a recipe with its id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRecipeList($id)
    {
        $recipeList = ListRecipe::find($id);
        $image = $recipeList->image;
        if ($image != "default.png") {
            File::delete("recipes/images/". Auth::user()->id . "/" . $image);
        }
        $recipeList->delete();
        return redirect()->route('listRecipe')->with('success delete', '"'. $recipeList['name'] . '" has been removed');
    }

    /**
     * Delete a ingredient (product) in the recipe with the the id of the recipe and the ingredient
     * @param $idRecipeList
     * @param $idRecipe
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRecipe($idRecipeList, $idRecipe)
    {
        $recipe = Recipe::find($idRecipe);
        $recipe->delete();
        return redirect()->route('editRecipe', $idRecipeList)->with('success delete', 'An ingredient has been removed');;
    }
}
