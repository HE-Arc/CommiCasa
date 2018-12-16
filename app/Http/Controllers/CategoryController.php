<?php

namespace CommiCasa\Http\Controllers;

use CommiCasa\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    /**
     * Create a new CategoryController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display all the categories in the view listCategory by user id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listCategory()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();

        return view('category/listCategory')->with('categories', $categories);
    }

    /**
     * Delete a category selelected by its id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('listCategory')->with('success delete', '"' . $category['name'] . '" has been removed');
    }

    /**
     * Update a category using its id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if($request->isMethod('post'))
        {
            $parameters = $request->except(['_token']);
            //Database
            $category->name = $parameters['name'];
            $category->save();
            return redirect()->route('listCategory')->with('success add', $request['name'] . ' has been updated');
        }

        return view('category/addCategory')->with('category', $category);
}

    /**
     * Redirect toward the view addCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addCategory()
    {
        return view('category/addCategory');
    }

    /**
     * Create a new category and after redirect toward the list of category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCategory(Request $request)
    {
        $parameters = $request->except(['_token']);
        Category::create($parameters);

        return redirect()->route('listCategory')->with('success add', 'New category has been added');

    }
}
