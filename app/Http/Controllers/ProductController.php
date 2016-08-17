<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Category;
use App\Product;
use Session;
use App\Size;
use App\Color;
use App\ProColor;
use App\ProSize;
use Input;
use App\Image;
use DB;
class ProductController extends Controller
{

    //Show a product details
    public function showDetail($id){
        $product = Product::find($id);
        $img_prods = Image::where('pro_id', $id)->get();
        $img_colors = ProColor::join('colors', 'colors.id', '=', 'procolors.color_id')->where('pro_id', $id)->get();
        $sizes = ProSize::join('sizes', 'sizes.id', '=', 'prosizes.size_id')->where('pro_id', $id)->get();
        $products = Product::where('cat_id', $product->cat_id)->orderByRaw("RAND()")->take(8)->get();
        
        return view('pages.product', compact('product', 'img_prods', 'img_colors', 'sizes', 'products'));
    }

    //show all categories
    public function getProFollowCate($id){
        $cat = Category::find($id);
        $name_cate = $cat->cat_title;
        $parent_id = $cat->parent_id;
        $cate_id = $id;
        if($parent_id == 0){
            $cat_childs = Category::where('parent_id', $id)->get();
            $data = array();
            foreach($cat_childs as $cat_child){
                array_push($data, $cat_child->id);
            }
            $pro_cate = Product::select('id','pro_name','image','price','cat_id', 'discount')->whereIn('cat_id', $data)->get();
            return view('pages.category', compact('name_cate','parent_id','pro_cate','cate_id','title'));
        }
        else {
            $pro_cate = Product::select('id', 'pro_name', 'image', 'price', 'cat_id', 'discount')->where('cat_id', $id)->get();
            $parent = Category::find($parent_id);
            $parent_name = $parent->cat_title;
            return view('pages.category', compact('name_cate','parent_id','pro_cate','parent_name','cate_id','title'));
        }
    }

    public function getProductByFilter($id, Request $request){
        $strColorIds = explode(';', $request->strColorId);
        $strSizeIds = explode(';', $request->strSizeId);
        $arrColorId = array();
        foreach($strColorIds as $strColorId){
            if($strColorId != '')
                array_push($arrColorId, $strColorId);
        }
        $arrSizeId = array();
        foreach($strSizeIds as $strSizeId){
            if($strSizeId != '')
                array_push($arrSizeId, $strSizeId);
        }
        $cat = Category::find($id);
        if($cat->parent_id == 0){
            $cat_childs = Category::where('parent_id', $id)->get();
            $cat_id = array();
            foreach($cat_childs as $cat_child){
                array_push($cat_id, $cat_child->id);
            }
            $pro_cate = Product::select('products.id as id','pro_name','image','price','cat_id', 'discount')
                ->whereIn('cat_id', $cat_id);
        }
        else{
            $pro_cate = Product::join('procolors', 'procolors.pro_id', '=', 'products.id')
                ->join('prosizes', 'prosizes.pro_id', '=', 'products.id')
                ->select('products.id as id', 'pro_name', 'image', 'price', 'cat_id', 'discount')->where('cat_id', $id);
        }
        if(sizeof($arrColorId) > 0)
            $pro_cate = $pro_cate->join('procolors', 'procolors.pro_id', '=', 'products.id')->whereIn('color_id', $arrColorId);
        if(sizeof($arrSizeId) > 0)
            $pro_cate = $pro_cate->join('prosizes', 'prosizes.pro_id', '=', 'products.id')->whereIn('size_id', $arrSizeId);
        if($request->price_to > 0)
            $pro_cate = $pro_cate->whereBetween('price', [$request->price_from, $request->price_to]);

        return ($pro_cate->distinct()->get());
    }

    //Admin zone
    public function getListPro(){
        $products = Product::all();
    	return view('admin.product.list', compact('products'));
    }

    // Product
    public function getSizeColor(){
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.product.size_color', compact('sizes', 'colors'));
    }

    //Show a product
    public function show($id){
        $product = Product::findOrFail($id);
        $sizes = ProSize::join('sizes', 'prosizes.size_id', '=', 'sizes.id')
            ->where('pro_id', '=', $id)->get();
        $colors = Image::join('colors', 'images.color_id', '=', 'colors.id')
            ->where('pro_id', '=', $id)->get();
        return view('admin.product.show', compact('product', 'sizes', 'colors'));
    }


    //Edit product
    public function edit($id){
        $product = Product::findOrFail($id);
        $pro_cat = Category::select('id', 'cat_title', 'parent_id')->get();
        $sizes = ProSize::join('sizes', 'prosizes.size_id', '=', 'sizes.id')
            ->where('pro_id', '=', $id)->get();
        $colors = Image::join('colors', 'images.color_id', '=', 'colors.id')
            ->where('pro_id', '=', $id)->get();
        return view('admin.product.edit', compact('product', 'sizes', 'colors', 'pro_cat'));
    }

    //Show all products
    public function index(){
        $products = Product::paginate(5);
        return view('admin.product.list', compact('products'));
    }
    //Create a product

    public function create(){
        $pro_cat = Category::select('id', 'cat_title', 'parent_id')->get();

        $sizes = Size::all();

        $colors = Color::all();
        return view('admin.product.add', compact('pro_cat', 'sizes', 'colors'));
    }
    //store a product
    public function store(ProductRequest $request){

        $file_name = $request->file('image')->getClientOriginalName();
        $product              = new Product();
        $product->pro_name    = $request->pro_name;
        $product->pro_code    = $request->pro_code;
        $product->cat_id      = $request->cat_id;
        $product->price       = $request->price;
        $product->discount    = $request->discount;
        $product->full_des    = $request->full_des;
        $product->image       = $file_name;
        $target = 'upload/images';
        $request->file('image')->move($target, $file_name);
        $product->save();

        $pro_id = $product->id;
        if($request->hasFile('images')) {
            foreach($request->file('images') as $img){
                $image = new Image();
                if(isset($img)) {
                    $image->images = $img->getClientOriginalName();
                    $image->pro_id = $pro_id;
                    $img->move('upload/images/details',$img->getClientOriginalName());
                    $image->save();
                }
            }
        }
        $str_sizes = $request->str_sizes;
        $arr_sizes = explode(';', $str_sizes);
        for ($i=0; $i < sizeof($arr_sizes)-1 ; $i++) {
            $size = new ProSize();
            $size->pro_id = $pro_id;
            $size->size_id = $arr_sizes[$i];
            $size->save();
        }

        $str_colors = $request->str_colors;
        $arr_colors = explode(';', $str_colors);
        for ($i=0; $i < sizeof($arr_colors)-1 ; $i++) {
            $color = new Image();
            $color->pro_id = $pro_id;
            $color->color_id = $arr_colors[$i];
            $color->save();
        }


        Session::flash('message', 'Created successfully');
        return redirect()->route('admin.product.show', $product->id);

    }

    //Update a product
    public function update(Request $request, $id){
        $this->validate($request, [
            'pro_name' => 'required',
            'pro_code' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'full_des' => 'required|min:60'
        ]);


        // $file_name = $request->file('image')->getClientOriginalName();
        $product              = Product::find($id);
        $product->id          = $id;
        $product->pro_name    = $request->pro_name;
        $product->pro_code    = $request->pro_code;
        $product->price       = $request->price;
        $product->discount    = $request->discount;
        $product->cat_id      = $request->cat_id;
        $product->full_des    = $request->full_des;
        // $product->image       = $file_name;
        // $target = 'upload/images';
        // $request->file('image')->move($target, $file_name);
        $product->save();
        $pro_id = $product->id;
        $str_sizes = $request->str_sizes;
        $arr_sizes = explode(';', $str_sizes);
        for ($i=0; $i < sizeof($arr_sizes)-1 ; $i++) {
            $size = new ProSize();
            $size->pro_id = $pro_id;
            $size->size_id = $arr_sizes[$i];
            $size->save();
        }



        Session::flash('message', 'Changed successfully');
        return redirect()->route('admin.product.show', $product->id);

    }

    //Delete a product
    public function destroy($id){
        $images = Product::find($id)->images->toArray();
        $color = Product::find($id)->colors->toArray();
        $color->delete($id);

        foreach($images as $image) {
            File::delete('upload/images/details'.$image['images']);
        }

        $pro = ProSize::find($id)->sizes->toArray();
        $pro->delete($id);

        $product = Product::find($id);
        File::delete('upload/images/'.$product->image);
        $product->delete();

        Session::flash('delete', 'Deleted successfully!');
        return redirect()->route('admin.product.index');
    }
}
