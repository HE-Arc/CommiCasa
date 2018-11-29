<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Product;
use CommiCasa\Category;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listProduct()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('product/listProduct', compact('products'));
    }

    public function addProduct()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();

        return view('product/addProduct', compact( 'categories'));
    }

    public function validProduct(Request $request)
    {

        //var_dump($parameters);

        $parameters = $request->except('_token');

        if($request->hasFile('image')) {
            $imageNameWithExt = $request->file('image')->getClientOriginalName();

            $image = pathinfo($imageNameWithExt, PATHINFO_FILENAME);

            $extension = $request->file(image)->getClientOriginalExtension();

            $imageNameToStore = $imageNameWithExt.'.'.$extension;

            $path = $request->file('image')->storeAs('public/products/images', $imageNameToStore);
        } else {
            $imageNameToStore = '';
        }

        if($parameters['regular'] == 'off')
            $parameters['regular'] = 0;
        else
            $parameters['regular'] = 1;

        $product = new Product();


        $product->name = $parameters['name'];
        $product->quantity = $parameters['quantity'];
        $product->user_id = auth()->user()->id;
        $product->category_id = $parameters['category_id'];
        $product->regular = $parameters['regular'];
        $product->alert = $parameters['alert'];
        $product->description = $parameters['description'];
        $product->image = $imageNameToStore;

        $product->save();

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

    public function editProduct(Request $request, $id)
    {
        //var_dump($request); die;
        $categories = Category::All();
        $product = Product::find($id);

        if($request->isMethod('post'))
        {
            $parameters = $request->except(['_token']);

            if($parameters['image'] == null)
                $parameters['image'] = 'null';
            if($parameters['description'] == null)
                $parameters['description'] = 'null';
            if($parameters['regular'] == 'off')
                $parameters['regular'] = 0;
            else
                $parameters['regular'] = 1;

            $product->name = $parameters['name'];
            $product->category_id = $parameters['category_id'];
            $product->quantity = $parameters['quantity'];
            $product->regular = $parameters['regular'];
            $product->alert = $parameters['alert'];
            $product->description = $parameters['description'];
            $product->image = $parameters['image'];

            $product->save();
            return redirect()->route('listProduct')->with('success', 'Product has been updated');
        }

        return view('product/addProduct', compact('product', 'categories'));
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('listProduct')->with('success', 'Product was deleted');
    }

    public function backWithMessage($type, $message)
    {
        return back()->with($type, $message);
    }

}
