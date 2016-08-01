<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Category;
use App\Product;
use App\Image;
use App\ProSize;
class ProductController extends Controller
{
    public function showDetail($id){
        $product = Product::find($id);
        $img_colors = Image::join('colors', 'colors.id', '=', 'images.id')->where('pro_id', '=', $id)->get();
        $sizes = ProSize::join('sizes', 'sizes.id', '=', 'prosizes.size_id')->where('pro_id', '=', $id)->get();
        
        return view('pages.product', compact('product', 'img_colors', 'sizes'));
    }

    //Admin zone
    public function getListPro(){
        $products = Product::all();
    	return view('admin.product.list', compact('products'));
    }

    public function getProFollowCate($id, $name_cate){
        $pa = Category::select('cat_title','parent_id')->where('id',$id)->first();
        $parent_id = $pa->parent_id;
        if($parent_id == 0){
            $pro_cate = Product::select('id','pro_name','image','price','cat_id')->whereIn('cat_id',[$id+1, $id+2])->get();
            return view('pages.category', compact('name_cate','parent_id','pro_cate'));
        }
        else {
            $pro_cate = Product::select('id', 'pro_name', 'image', 'price', 'cat_id')->where('cat_id', $id)->get();
            $parent = Category::select('cat_title')->where('id',$parent_id)->first();
            $parent_name = $parent->cat_title;
            return view('pages.category', compact('name_cate','parent_id','pro_cate','parent_name'));
        }
    }

    public function getAddPro(){
        $pro_cat = Category::select('id', 'cat_title', 'parent_id')->get()->toArray();
    	return view('admin.product.add', compact('pro_cat'));
    }

    public function postAddPro(ProductRequest $request){

        $file_name = $request->file('image')->getClientOriginalName();
    	$product              = new Product();
        $product->pro_name    = $request->pro_name;
    	$product->pro_code    = $request->pro_code;
    	$product->cat_id      = $request->cat_id;
    	$product->price       = $request->price;
    	$product->discount    = $request->discount;
        $product->short_des   = $request->short_des;
    	$product->full_des    = $request->full_des;
        $product->image       = $file_name;
        $target = 'upload/images';
        $request->file('image')->move($target, $file_name);
        $product->save();


        
    }
}
