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
use App\Cart;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function getCheckout(){
        $carts = \Cart::content();
        return view('pages.checkout', compact('carts'));
    }

    public function postCheckout(CheckoutRequest $request){
        try {
            if(!Auth::check()) {
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->save();
            }
            else{
                $customer = Customer::find(Auth::user()->userable_id);
            }
            $order = new Order;
            $order->customer_id = $customer->id;
            $order->total_money = \Cart::subtotal();
            $order->status = 0;
            $order->save();

            $carts = \Cart::content();
            foreach($carts as $cart){
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->pro_id = $cart->options->product_id;
                $order_detail->color_id = $cart->options->color_id;
                $order_detail->size_id = $cart->options->size_id;
                $order_detail->pro_name = $cart->name;
                $order_detail->price = $cart->price - $cart->discount;
                $order_detail->qty = $cart->qty;
                $order_detail->save();
            }
            \Cart::destroy();
            return redirect('checkout')
                ->with('message', 'Đặt hàng thành công. Chúng tôi sẽ sớm liên lạc với bạn!')
                ->with('alert-class', 'alert-success')
                ->with('fa-class', 'fa-check');
        }catch(\Exception $e){
            dd(get_class($e));
        }
    }
}