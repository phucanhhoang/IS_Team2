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
use App\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use DB;

class CheckoutController extends Controller
{
    public function getCheckout(){
        $carts = \Cart::content();
        $provinces = DB::table('provinces')->get();
        if(Auth::check()) {
            $customer = Auth::user();
            if ($customer->province_id != 0)
                $districts = DB::table('districts')->where('province_id', $customer->province_id)->get();
        }

        return view('pages.checkout', compact('carts', 'provinces', 'customer', 'districts'));
    }

    public function postCheckout(CheckoutRequest $request){
        try {
            if(!Auth::check()) {
                $cus = Customer::where('phone', $request->phone)->orWhere('email', $request->email);
                if($cus->count() > 0){
                    $customer = $cus->first();
                }
                else {
                    $customer = new Customer;
                }
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->email = $request->email;
                $customer->address = $request->address;
                $customer->district_id = $request->district;
                $customer->province_id = $request->province;
                $customer->save();
            }
            else{
                $customer = Auth::user();
            }

            $order = new Order;
            $order->customer_id = $customer->id;
            $order->total_money = \Cart::subtotal();
            $order->status = 0;
            $order->customer_name = $customer->name;
            $order->phone = $customer->phone;
            $order->email = $customer->email;
            $order->address = $request->address.', '.
                mb_convert_case(DB::table('districts')->where('id', $request->district)->first()->name, MB_CASE_TITLE, "UTF-8").', '.
                mb_convert_case(DB::table('provinces')->where('id', $request->province)->first()->name, MB_CASE_TITLE, "UTF-8");
            $order->save();

            $carts = \Cart::content();
            foreach($carts as $cart){
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->pro_id = $cart->options->product_id;
                $order_detail->color_id = $cart->options->color_id;
                $order_detail->size_id = $cart->options->size_id;
                $order_detail->pro_name = $cart->name;
                $order_detail->pro_image = $cart->options->image;
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