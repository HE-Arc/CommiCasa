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
        $categories = Category::all();

        return view('category/listCategory')->with('categories', $categories);
    }

    public function showCategory($id)
    {
        $category = Category::find($id);

        return view('category/showCategory')->with('category', $category);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        var_dump($category);
        return redirect()->route('listCategory')->with('success', 'Category vas deleted');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if($request->isMethod('post'))
        {
            $parameters = $request->except(['_token']);
            //Databass
            $category->name = $parameters['name'];
            $category->save();
            return redirect()->route('listCategory')->with('success', 'Category vas updated');
        }

        return view('category/addCategory')->with('category', $category);
    }

    public function addCategory()
    {
        return view('category/addCategory');
    }

    public function createCategory(Request $request)
    {
        $parameters = $request->except(['_token']);

//        //Database
//        $category = new Category();
//        $category->name = $parameters['name']
//        $category->save();

        Category::create($parameters);


        return redirect()->route('listCategory')->with('success', __('Category has been add !'));
        //return redirect()->back()->with('message', 'IT WORKS!');

    }
}
