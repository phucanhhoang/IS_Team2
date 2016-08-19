<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Category;
use App\Size;
use Session;

class CategoryController extends Controller
{
    //Show all categories
    public function index(){
        $cats = Category::all();
        return view('admin.category.list', compact('cats'));
    }

    //Create a new category
    public function create(){
        $cats = Category::all();
        $parents = Category::where('parent_id', '=', 0)->get();
        return view('admin.category.add', compact('cats', 'parents'));
    }

    //Store a category
    public function store(CategoryRequest $request){
        $cat            = new Category;
        $cat->cat_title = $request->cat_title;
        $cat->parent_id = $request->parent_id;
        $cat->save();
        Session::flash('success','Created successfully!');
        return redirect()->route('admin.category.index');
    }

    //Edit a category
    public function edit($id){
        $cat = Category::find($id);
        return view('admin.category.edit', compact('cat'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'cat_title' => 'required'
        ]);

        $cat            = Category::findOrFail($id);
        $cat->cat_title = $request->cat_title;
        $cat->save();

        Session::flash('success', 'Changes the category successfully!');
        return redirect()->route('admin.category.index');
    }
    //Delete a category
    public function destroy($id){
        $cat_id = Category::find($id);
        $cat_id->delete($id);

        Session::flash('success', 'Deleted successfully!');
        return redirect()->route('admin.category.index');

    }
}
