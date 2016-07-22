<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Category;
class CategoryController extends Controller
{
	public function getListCat(){
        $cats = Category::all();
    	return view('admin.category.list', compact('cats'));
    }

    public function getAddCat(){
    	$parent = Category::select('cat_id', 'cat_title', 'parent_id')->get()->toArray();
    	return view('admin.category.add', compact('parent'));
    }

    public function postAddCat(CategoryRequest $request){
    	$cat = new Category;
    	$cat->cat_title = $request->cat_title;
    	$cat->parent_id = $request->parent_id;
    	$cat->save();

    	return redirect()->route('admin.category.getListCat')->with(['level' => 'success', 'message' => '<strong>Congratulation!</strong>. Add Category completely']);
    }
}
