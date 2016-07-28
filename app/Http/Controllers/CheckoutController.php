<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/26/2016
 * Time: 9:52 AM
 */

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Product;
use App\Image;
use App\ProSize;
use App\Cart;
use App\Customer;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function getCheckout(){
        $cart = Cart::join('products', 'products.id', '=', 'cart.product_id')
            ->join('images', function ($join) {
                $join->on('images.pro_id', '=', 'cart.product_id');
                $join->on('images.color_id', '=', 'cart.color_id');
            })
            ->join('colors', 'colors.id', '=', 'cart.color_id')
            ->join('sizes', 'sizes.id', '=', 'cart.size_id')
            ->select('cart.id as id', 'product_id', 'pro_name', 'cart.quantity as quantity', 'products.price as price',
                'images.images as image','colors.color as color', 'size', 'discount');
        if(Auth::check()){
            $carts = $cart->where('user_id', '=', Auth::user()->id)->get();
        }
        else{
            $carts = $cart->where('remember_token', '=', csrf_token())->get();
        }

        return view('pages.checkout', compact('carts'));
    }

    public function postCheckout(Request $request){
//        try {
            if(!Auth::check()){
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->save();

                $order = new Order;
                $order->customer_id = $customer->id;
                $order->status = 0;
                $order->save();

                $carts = Cart::join('products', 'products.id', '=', 'cart.product_id')
                    ->where('remember_token', '=', csrf_token());
                foreach($carts->get() as $cart){
                    $order_detail = new OrderDetail;
                    $order_detail->order_id = $order->id;
                    $order_detail->pro_id = $cart->product_id;
                    $order_detail->color_id = $cart->color_id;
                    $order_detail->size_id = $cart->size_id;
                    $order_detail->pro_name = $cart->pro_name;
                    $order_detail->price = $cart->price - $cart->price * $cart->discount / 100;
                    $order_detail->qty = $cart->quantity;
                    $order_detail->save();
                }
                $carts->delete();
            }
            return redirect('checkout')
                ->with('message', 'Đặt hàng thành công. Chúng tôi sẽ sớm liên lạc với bạn!')
                ->with('alert-class', 'alert-success')
                ->with('fa-class', 'fa-check');
//        }catch(\Exception $e){
//            dd(get_class($e));
//        }
    }
}