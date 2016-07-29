<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/25/2016
 * Time: 1:45 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request){
        $cart_old = Cart::where('product_id', '=', $request->product_id)
            ->where('color_id', '=', $request->color_id)
            ->where('size_id', '=', $request->size_id)
            ->where(function ($query) use ($request) {
                $query->where('user_id', '=', Auth::check() ? Auth::user()->id : 0)
                    ->orWhere('remember_token', '=', $request->header('X-CSRF-TOKEN'));
            });
        if ($cart_old->count() > 0) {
            $check = $cart_old->firstOrFail()->update(['quantity' => $cart_old->firstOrFail()->quantity + $request->quantity]);
        }
        else {
            $cart = new Cart;
            if (Auth::check()) {
                $cart->user_id = Auth::user()->id;
            }
            $cart->product_id = $request->product_id;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->quantity = $request->quantity;
            $cart->remember_token = $request->header('X-CSRF-TOKEN');
            $check = $cart->save();
        }
        if($check){
            $cart = Cart::join('products', 'products.id', '=', 'cart.product_id')
                ->join('images', function ($join) {
                    $join->on('images.pro_id', '=', 'cart.product_id');
                    $join->on('images.color_id', '=', 'cart.color_id');
                })
                ->join('colors', 'colors.id', '=', 'cart.color_id')
                ->join('sizes', 'sizes.id', '=', 'cart.size_id')
                ->select('cart.id as id', 'product_id', 'pro_name', 'cart.quantity as quantity', 'products.price as price',
                    'images.images as image', 'size', 'discount');
            if(Auth::check()){
                $carts = $cart->where('user_id', '=', Auth::user()->id)->get();
            }
            else{
                $carts = $cart->where('remember_token', '=', csrf_token())->get();
            }
            return $carts;
        }
        else{
            return 'false';
        }
    }

    public function delete(Request $request){
        $check = Cart::find($request->id)->delete();
        if ($check) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function change(Request $request){
        $cart = Cart::find($request->id);
        $old_qty = $cart->quantity;
        $cart->quantity = $request->quantity;
        $check = $cart->save();
        $delta_qty = $request->quantity - $old_qty;

        if($check) {
            $data = array(
                'msg' => 'true',
                'delta_qty' => $delta_qty
            );
            return $data;
        }
        else
            return 'false';
    }
}