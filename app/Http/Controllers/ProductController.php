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
class ProductController extends Controller
{

    //Show a product details
    public function showDetail($id){
        $product = Product::find($id);
        $img_prods = Image::where('pro_id', $id)->get();
        $img_colors = ProColor::join('colors', 'colors.id', '=', 'procolors.id')->where('pro_id', '=', $id)->get();
        $sizes = ProSize::join('sizes', 'sizes.id', '=', 'prosizes.size_id')->where('pro_id', '=', $id)->get();
        $products = Product::where('cat_id', $product->cat_id)->orderByRaw("RAND()")->take(8)->get();
        
        return view('pages.product', compact('product', 'img_prods', 'img_colors', 'sizes', 'products'));
    }

    //show all categories
    public function getProFollowCate($id){
        $pa = Category::select('cat_title','parent_id')->where('id',$id)->first();
        $name_cate = $pa->cat_title;
        $parent_id = $pa->parent_id;
        $cate_id = $id;
        $title = 'Sắp xếp theo';
        if($parent_id == 0){
            $pro_cate = Product::select('id','pro_name','image','price','cat_id', 'discount')->whereIn('cat_id',[$id+1, $id+2])->paginate(12);
            return view('pages.category', compact('name_cate','parent_id','pro_cate','cate_id','title'));
        }
        else {
            $pro_cate = Product::select('id', 'pro_name', 'image', 'price', 'cat_id', 'discount')->where('cat_id', $id)->paginate(12);
            $parent = Category::select('cat_title')->where('id',$parent_id)->first();
            $parent_name = $parent->cat_title;
            return view('pages.category', compact('name_cate','parent_id','pro_cate','parent_name','cate_id','title'));
        }
    }

    public function getSort($cate_id, $sort_id){
        $pa = Category::select('cat_title','parent_id')->where('id',$cate_id)->first();
        $name_cate = $pa->cat_title;
        $parent_id = $pa->parent_id;
        if($parent_id == 0){
            if($sort_id == 1){
                $pro_cate = Product::select('id','pro_name','image','price','cat_id', 'discount')->whereIn('cat_id',[$cate_id+1, $cate_id+2])->orderBy('pro_name','ASC')->paginate(12);
                $title = 'Tên: Từ A đến Z';
            }
            if($sort_id == 2){
                $pro_cate = Product::select('id','pro_name','image','price','cat_id', 'discount')->whereIn('cat_id',[$cate_id+1, $cate_id+2])->orderBy('pro_name','DESC')->paginate(12);
                $title = 'Tên: Từ Z đến A';
            }
            if($sort_id == 3){
                $pro_cate = Product::select('id','pro_name','image','price','cat_id', 'discount')->whereIn('cat_id',[$cate_id+1, $cate_id+2])->orderBy('price','DESC')->paginate(12);
                $title = 'Giá: Từ cao đến thấp';
            }
            if($sort_id == 4){
                $pro_cate = Product::select('id','pro_name','image','price','cat_id', 'discount')->whereIn('cat_id',[$cate_id+1, $cate_id+2])->orderBy('price','ASC')->paginate(12);
                $title = 'Giá: Từ thấp đến cao';
            }
            return view('pages.category', compact('name_cate','parent_id','pro_cate','cate_id','title'));
        }
        else {
            if($sort_id == 1){
                $pro_cate = Product::select('id', 'pro_name', 'image', 'price', 'cat_id', 'discount')->where('cat_id', $cate_id)->orderBy('pro_name','ASC')->paginate(12);
                $title = 'Tên: Từ A đến Z';
            }
            if($sort_id == 2){
                $pro_cate = Product::select('id', 'pro_name', 'image', 'price', 'cat_id', 'discount')->where('cat_id', $cate_id)->orderBy('pro_name','DESC')->paginate(12);
                $title = 'Tên: Từ Z đến A';
            }
            if($sort_id == 3){
                $pro_cate = Product::select('id', 'pro_name', 'image', 'price', 'cat_id', 'discount')->where('cat_id', $cate_id)->orderBy('price','DESC')->paginate(12);
                $title = 'Giá: Từ cao đến thấp';
            }
            if($sort_id == 4) {
                $pro_cate = Product::select('id', 'pro_name', 'image', 'price', 'cat_id', 'discount')->where('cat_id', $cate_id)->orderBy('price','ASC')->paginate(12);
                $title = 'Giá: Từ thấp đến cao';
            }
            $parent = Category::select('cat_title')->where('id',$parent_id)->first();
            $parent_name = $parent->cat_title;
            return view('pages.category', compact('name_cate','parent_id','pro_cate','parent_name','cate_id','title'));
        }
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
