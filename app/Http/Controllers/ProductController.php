<?php

namespace CommiCasa\Http\Controllers;


use Illuminate\Http\Request;
use CommiCasa\Product;
use CommiCasa\Category;
use CommiCasa\Shopping;
use Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Create a new ProductController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the list of product in view listProduct
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listProduct()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('product/listProduct', compact('products', 'categories'));
    }

    /**
     * Redirect to the view addProduct with in parameter the id of the user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProduct()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();

        return view('product/addProduct', compact( 'categories'));
    }

    /**
     * Get the parameters of the new product and create it
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function validProduct(Request $request)
    {
        if($request['regular'] == 'off')
            $request['regular'] = 0;
        else
            $request['regular'] = 1;

        $path = 'products/images/' . Auth::user()->id;
        $file = $request->file('image');

        if($request->hasFile('image')){
            $fileName = $request['name'] . '-' .$request->file('image')->getClientOriginalName();
            $file->move($path, $fileName);
        } else {
            $fileName = "default.png";
        }

        $product = new Product();


        $product->name = $request['name'];
        $product->quantity = $request['quantity'];
        $product->user_id = Auth::user()->id;
        $product->category_id = $request['category_id'];
        $product->regular = $request['regular'];
        $product->alert = $request['alert'];
        $product->description = $request['description'];
        $product->image = $fileName;

        $product->save();
        $this->checkRegular($product->id);

            return redirect()->route('listProduct')->with('success add', '"' . $product->name.'" has been added');
    }


    /**
     * Get the product by id and increase or decrease his quantity by 1
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct(Request $request)
    {
        $param = $request->except('_token');
        $product = Product::where('id', $param['product_id'])->first();

        if($param['quantity'] == '1')
        {
            $param['quantity'] = $product->quantity + 1;
            $product->update($param);
            return $this->backWithMessage('success add', 'Quantity of "' . $product->name . '" has been increased of 1');
        }
        else
        {
            if(!$product->quantity <= 0)
            {
                $param['quantity'] = $product->quantity - 1;
                $product->update($param);
            }
                return $this->backWithMessage('success delete', 'Quantity of "' . $product->name . '" has been decreased of 1');
        }
    }

    /**
     * Get the product by id and edit it if the method is POST. Otherwise redirect to the view addProduct with the id of the product.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editProduct(Request $request, $id)
    {
        //var_dump($request); die;
        $categories = Category::where('user_id', Auth::user()->id)->get();
        $product = Product::find($id);
        $image = $product['image'];
        if($request->isMethod('post'))
        {
            $parameters = $request->except(['_token']);

            if($parameters['regular'] == 'off')
                $parameters['regular'] = 0;
            else
                $parameters['regular'] = 1;

            $path = 'products/images/' . Auth::user()->id;
            $file = $request->file('image');

            if($request->hasFile('image')){
                $fileName = $id. '-' .$request->file('image')->getClientOriginalName();
                $file->move($path, $fileName);
                $product->image = $fileName;

                if($image != "default.png"){
                    File::delete("products/images/". Auth::user()->id . "/" . $image);
                }
            }

            $product->name = $parameters['name'];
            $product->category_id = $parameters['category_id'];
            $product->quantity = $parameters['quantity'];
            $product->regular = $parameters['regular'];
            $product->alert = $parameters['alert'];
            $product->description = $parameters['description'];


            $product->save();

            return redirect()->route('listProduct')->with('success add', '"' . $product->name.'" has been updated');
        }

        return view('product/addProduct', compact('product', 'categories'));
    }

    /**
     * Delete the product with its id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id)
    {
        $product = Product::where('id', $id)->first();
        
        $image = $product->image;

        if($image != "default.png"){
            File::delete("products/images/". Auth::user()->id . "/" . $image);
        }
        $product->delete();
        return redirect()->route('listProduct')->with('success delete', '"' . $product->name.'" has been removed');
    }

    /**
     * Check if the checkbox is checked. If true, also add the product to the shopping list automatically.
     * @param $id
     */
    public static function checkRegular($id)
    {
        $shopID = Shopping::where('product_id', $id)->first();
        if(!isset($shopID))
        {
            $product = Product::find($id);
            if ($product->regular != 0) {
                if ($product->alert > $product->quantity || $product->quantity == 0) {
                    $shopping = new Shopping();
                    $shopping->product_id = $product->id;
                    $shopping->user_id = Auth::user()->id;
                    $shopping->save();
                }
            }
        }
    }

    /**
     * Check if a product by its id is in the shopping list
     * @param $id
     * @return bool
     */
    public static function checkIfProductIsInShopping($id)
    {
        $shopID = Shopping::where('product_id', $id)->first();
        if(!isset($shopID))
            return false;
        else
            return true;
    }

    /**
     * Redirect to a view with a message
     * @param $type
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function backWithMessage($type, $message)
    {
        return back()->with($type, $message);
    }

}
