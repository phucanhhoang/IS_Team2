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
    //Edit a category
    public function edit($id){
        $cat = Category::find($id);
        return view('admin.category.edit', compact('cat'));
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

    	return redirect()->route('admin.category.index')->with(['level' => 'success', 'message' => '<strong>Congratulation!</strong>. Add Category completely']);
    }


    public function update(Request $request, $id){
        $this->validate($request, [
            'cat_title' => 'required'
        ]);

        $cat            = Category::findOrFail($id);
        $cat->cat_title = $request->cat_title;
        $cat->save();

        Session::flash('msg', 'Changes the category successfully!');
        return redirect()->route('admin.category.index');
    }

    public function destroy($id){
        $cat_id = Category::find($id);
        $parent = Category::where('parent_id', '=', $id)->count();
        if($parent == 0) {
            $cat_id->delete($id);
            Session::flash('delete', 'Deleted successfully!');
            return redirect()->route('admin.category.index');
        } else {
            echo "<script>
                alert('Sorry.You can/'t delete this category!');
                window.location = '";
                    echo route('admin.category.index');
                echo "'
            </script>";
        }
    }

    public function newCatParent(Request $request){

        $cat = new Category();
        $cat->cat_title = $request->cat_title;
        $cat->parent_id = 0;
        $check = $cat->save();
        $cat_id = $cat->id;
        if($check)
            return $cat_id;
        else
            return 'false';
    }

    public function deleteSize($id){
        $size = Size::find($id);
        $size->delete();

        return redirect()->route('sizecolor');
    }
}
