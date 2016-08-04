<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/25/2016
 * Time: 1:45 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;
use App\Size;
use App\Image;
//use App\Cart;
//use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request){
//        $cart_old = Cart::where('product_id', '=', $request->product_id)
//            ->where('color_id', '=', $request->color_id)
//            ->where('size_id', '=', $request->size_id)
//            ->where(function ($query) use ($request) {
//                $query->where('user_id', '=', Auth::check() ? Auth::user()->id : 0)
//                    ->orWhere('remember_token', '=', $request->header('X-CSRF-TOKEN'));
//            });
//        if ($cart_old->count() > 0) {
//            $check = $cart_old->firstOrFail()->update(['quantity' => $cart_old->firstOrFail()->quantity + $request->quantity]);
//        }
//        else {
//            $cart = new Cart;
//            if (Auth::check()) {
//                $cart->user_id = Auth::user()->id;
//            }
//            $cart->product_id = $request->product_id;
//            $cart->color_id = $request->color_id;
//            $cart->size_id = $request->size_id;
//            $cart->quantity = $request->quantity;
//            $cart->remember_token = $request->header('X-CSRF-TOKEN');
//            $check = $cart->save();
//        }
//        if($check){
//            $cart = Cart::join('products', 'products.id', '=', 'cart.product_id')
//                ->join('images', function ($join) {
//                    $join->on('images.pro_id', '=', 'cart.product_id');
//                    $join->on('images.color_id', '=', 'cart.color_id');
//                })
//                ->join('colors', 'colors.id', '=', 'cart.color_id')
//                ->join('sizes', 'sizes.id', '=', 'cart.size_id')
//                ->select('cart.id as id', 'product_id', 'pro_name', 'cart.quantity as quantity', 'products.price as price',
//                    'images.images as image', 'size', 'discount');
//            if(Auth::check()){
//                $carts = $cart->where('user_id', '=', Auth::user()->id)->get();
//            }
//            else{
//                $carts = $cart->where('remember_token', '=', csrf_token())->get();
//            }
//            return $carts;
//        }
//        else{
//            return 'false';
//        }

        $rowId = \Cart::search(array('options' => array(
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'product_id' => $request->product_id
        )));
        if($rowId){
            $cart = \Cart::get($rowId[0]);
            \Cart::update($rowId[0], $cart->qty + $request->quantity);
        }
        else{
            $product = Product::find($request->product_id);
            $color = Color::find($request->color_id);
            $size = Size::find($request->size_id);
            $image = Image::where('pro_id', $request->product_id)->where('color_id', $request->color_id)->get();

            \Cart::add(array(
                'id' => \Cart::count(false) + 1,
                'name' => $product->pro_name,
                'qty' => $request->quantity,
                'price' => $product->price,
                'discount' => $product->discount * $product->price / 100,
                'options' => array(
                    'size_id' => $request->size_id,
                    'color_id' => $request->color_id,
                    'product_id' => $request->product_id,
                    'color' => $color->color,
                    'size' => $size->size,
                    'image' => $image[0]->images
                )
            ));
        }

        return \Cart::content();
//        return $rowId;
    }

    public function delete(Request $request){
        $check = \Cart::remove($request->id);
        if ($check) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function change(Request $request){
        $check = \Cart::update($request->id, $request->quantity);
        $cart = \Cart::get($request->id);

        if($check) {
            $data = array(
                'msg' => 'true',
                'count' => \Cart::count(),
                'money' => ($cart->price - $cart->discount) * $request->quantity,
                'subtotal' => \Cart::subtotal()
            );
            return $data;
        }
        else
            return 'false';
    }
}