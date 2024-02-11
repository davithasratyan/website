<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories =  Category::all();
        return view('admin.pages.addNewCategory', ['categories'=>$categories]);
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required|string',
            'category_name' => 'required|string',
        ]);
        $category = new Category();
        $category->category = $request->category;
        $category->category_name = $request->category_name;
        $request->parentCategory ? $category->parent_id = $request->parentCategory : $category->parent_id = 0;
        $request->category_status ?  $category->status = $request->category_status : $category->status = 0;
        $category->save();

        return redirect()->back();

    }

    public function delete(Request $request){
        if (Category::find($request->category)){
            Category::find($request->category)->delete();
            if (PostCategory::where('category_id', $request->category)){
                PostCategory::where('category_id', $request->category)->delete();
            }
            return redirect()->back();
        }
        else {
            return redirect()->back();

        }
    }
}
