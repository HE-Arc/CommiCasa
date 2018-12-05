<?php

namespace CommiCasa\Http\Controllers;

use Illuminate\Http\Request;
use CommiCasa\Product;
use CommiCasa\Category;
use CommiCasa\Shopping;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;


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
        $parameters = $request->except('_token');

        //var_dump($parameters); die;

        if($request['regular'] == 'off')
            $request['regular'] = 0;
        else
            $request['regular'] = 1;

        $path = 'products/images/' . Auth::user()->id;
        $file = $request->file('image');

        if($request->hasFile('image')){
            $fileName = $request->file('image')->getClientOriginalName();
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
            $this->checkRegular($product->id);
            return redirect()->route('listProduct')->with('success', __('Product has been add !'));
        }
        else
        {
            if(!$product->quantity <= 0)
            {
                $param['quantity'] = $product->quantity - 1;
                $product->update($param);
                $this->checkRegular($product->id);
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

            $this->checkRegular($id);
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

    public function checkRegular($id)
    {
        $product = Product::find($id);
        if($product->regular != 0)
        {
            if($product->alert > $product->quantity || $product->quantity == 0)
            {
                $shopping = new Shopping();
                $shopping->product_id = $product->id;
                $shopping->user_id =  Auth::user()->id;
                $shopping->save();
            }
        }
    }

    public function backWithMessage($type, $message)
    {
        return back()->with($type, $message);
    }

}
