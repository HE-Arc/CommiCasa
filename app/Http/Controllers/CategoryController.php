<?php

namespace CommiCasa\Http\Controllers;

use CommiCasa\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listCategory()
    {
        $category = Category::all();

        return view('category/listCategory');
    }

    public function addCategory()
    {
        return view('category/addCategory');
    }

    public function validCategory(Request $request)
    {
        $parameters = $request->except(['_token']);

        //Database
        $category = new Category();
        $category->name = $parameters['name'];
        $category->save();

        return redirect()->route('listCategory')->with('success', 'Category was added.');
    }
}
