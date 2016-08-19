<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderDetailRequest;
use App\Http\Requests\CustomerRequest;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Prosize;
use App\Size;
use App\Customer;
use App\Image;
use App\Color;
use App\ProColor;
use DB;

class OrderController extends Controller
{
    public function getList()
    {
    	$orders = Order::select('id','customer_id','total_money as total','status','created_at as time','customer_name','phone')
                ->orderBy('time','desc')
                ->get();

    	return view('admin.order.list',compact('orders'));
    }

    public function getDetail($id)
    {
        $detail = OrderDetail::select('id','pro_id','pro_name','color_id','size_id','price','pro_image','qty','created_at as time','order_id')
                ->where('order_id','=',$id)
                ->orderBy('time','desc')
                ->get();

        $state = Order::select('customer_id','status')->where('id','=',$id)->get()->first();
        $sizes = Prosize::join('sizes', 'prosizes.size_id','=','sizes.id')
                ->select('sizes.id','sizes.size','prosizes.pro_id as product_id')
                ->get();

        $img_colors = ProColor::join('colors', 'procolors.color_id','=','colors.id')
                ->select('colors.id','colors.color','procolors.pro_id as product_id','procolors.color_id')
                ->get();

        $customers = Order::where('id','=',$id)
                ->get();
    	$data = Order::find($id);
    	return view('admin.order.detail',compact('detail','data','customers','sizes','img_colors','state'));
    }

    public function postChange($id, Request $request)
    {
        $data = Order::find($id);
        $data->status = $request->status;
        $data->save();
    	return redirect()->route('admin.order.list')->with(['level' => 'success', 'message' => 'Success!!! Complete change status!!']);
    }

    public function getEdit($id)
    {
        $details = OrderDetail::find($id);

        $customer = Order::where('id','=',$details->order_id)->get()->first();

        $state = Order::select('status')->where('id','=',$details->order_id)->get()->first();

        $product = Product::join('orderdetails','products.id','=','orderdetails.pro_id')
                ->select('products.discount','orderdetails.id')
                ->where('orderdetails.id','=',$id)
                ->get()
                ->first();

        $sizes = Prosize::join('sizes', 'prosizes.size_id','=','sizes.id')
                ->join('orderdetails','prosizes.pro_id','=','orderdetails.pro_id')
                ->select('sizes.id','sizes.size')
                ->where('orderdetails.id','=',$id)
                ->get();

        $img_colors = ProColor::join('colors', 'procolors.color_id','=','colors.id')
                ->join('orderdetails','procolors.pro_id','=','orderdetails.pro_id')
                ->select('colors.id','colors.color','procolors.pro_id as product_id','procolors.color_id')
                ->where('orderdetails.id','=',$id)
                ->get();
    	
    	return view('admin.order.edit',compact('details','customer','sizes','img_colors','state','id','product'));
    }

    public function postEdit($id, Request $request)
    {
        $detail = OrderDetail::find($id);
        $detail->size_id = $request->size_id;
        $detail->color_id = $request->color_id;
        if ($request->qty>0) {
            $detail->qty = $request->qty;
        } else{
            return redirect()->back()->with(['level' => 'danger', 'message' => 'Sorry!! Cannot edit this order! Please check the quantity field.']);
        }
        $detail->save();

        $product = Product::where('id','=',$detail->pro_id)->get()->first();

    	$data = Order::where('id','=',$detail->order_id)
                ->get()->first();
        $orders = OrderDetail::where('order_id','=',$detail->order_id)->get();
        $val = 0;
        foreach ($orders as $order) {
            $val += $product->price*$order->qty*(1-$product->discount/100);
        }
        $data->total_money = $val;
    	
        $data->save();
    	return redirect()->route('admin.order.list')->with(['level' => 'success', 'message' => 'Success!!! Complete edit order!!']);
    }

    public function getAdd()
    {
        $customers = Customer::select('id','name')->get();
        $products = Product::select('id','pro_name')->get();
        $sizes = ProSize::join('sizes', 'sizes.id', '=', 'prosizes.size_id')->select('sizes.id','prosizes.pro_id','sizes.size')->get();
        $img_colors = ProColor::join('colors', 'procolors.color_id','=','colors.id')
                ->select('colors.id','colors.color','procolors.color_id')
                ->groupBy('colors.id')
                ->get();
    	return view('admin.order.add',compact('customers','products','sizes','img_colors'));
    }

    public function postAdd(Request $request)
    {
        $order = new Order();

        $customers = Customer::where('phone','=',$request->custom_phone)->get()->first();
        $district = DB::table('districts')->where('id','=',$customers->district_id)->first();
        $province = DB::table('provinces')->where('id','=',$customers->province_id)->first();
        
        $order->customer_id = $customers->id;
        $order->status = 0;
        $order->customer_name = $customers->name;
        $order->phone = $customers->phone;
        $order->email = $customers->email;
        $order->address = $customers->address.' - '.$district->name.' - '.$province->name;
        $order->save();

        $val = 0;
        $carts = \Cart::content();
        if (count($carts)>0) {
            foreach($carts as $cart){
                $orderdetail = new OrderDetail();
                $orderdetail->order_id = $order->id;
                $orderdetail->pro_id = $cart->options->product_id;
                $orderdetail->color_id = $cart->options->color_id;
                $orderdetail->size_id = $cart->options->size_id;
                $orderdetail->pro_name = $cart->name;

                $product = Product::where('id','=',$orderdetail->pro_id)->get()->first();
                $orderdetail->pro_image = $product->image;
                
                $orderdetail->price = $product->price*(1-$product->discount/100);
                $orderdetail->qty = $cart->qty;
                $orderdetail->save();
                $val += $orderdetail->price*$orderdetail->qty;
            }
            \Cart::destroy();
        } else{
            $orderdetail = new OrderDetail();
            $orderdetail->order_id = $order->id;
            $orderdetail->pro_id = $request->product_id;
            $orderdetail->color_id = $request->color_id;
            $orderdetail->size_id = $request->size_id;
            $product = Product::where('id','=',$orderdetail->pro_id)->get()->first();
            $orderdetail->pro_name = $product->pro_name;
            $orderdetail->pro_image = $product->image;
            
            $orderdetail->price = $product->price*(1-$product->discount/100);
            $orderdetail->qty = $request->qty;
            $orderdetail->save();
            $val += $orderdetail->price*$orderdetail->qty;
        }

        $order->total_money = $val;
        $order->save();

        return redirect()->route('admin.order.list')->with(['level' => 'success', 'message' => 'Success!!! Complete add order!!']);
    }

    public function proChange(Request $request){
        $sizes = Prosize::join('sizes', 'sizes.id', '=', 'prosizes.size_id')
                ->where('pro_id', $request->pro_id)->get();
        $colors = ProColor::join('colors', 'colors.id', '=', 'procolors.color_id')
                ->where('pro_id', $request->pro_id)->get();
        $data = array(
            'sizes' => $sizes,
            'colors' => $colors
        );
        return $data;
    }

    public function searchItem()
    {
        $customers = Customer::join('districts','customers.district_id','=','districts.id')
                ->join('provinces','customers.province_id','=','provinces.id')
                ->select('customers.name','customers.phone','customers.email','customers.address','districts.name as district','provinces.name as province')
                ->get();
        $data = array();
        foreach ($customers as $customer) {
            array_push($data, $customer->name.' - '.$customer->phone.' - '.$customer->email.' - '.$customer->address.' - '.$customer->district.' - '.$customer->province);
        }
        return $data;
    }

    public function orderShow(Request $request)
    {


        $order = DB::table('orderdetails')
                ->join('products','orderdetails.pro_id','=','products.id')
                ->join('colors','orderdetails.color_id','=','colors.id')
                ->join('sizes','orderdetails.size_id','=','sizes.id')
                ->select('products.pro_name as name', 'colors.color as color','sizes.size as size','orderdetails.qty as quantity')
               
                ->where('sizes.id','=',$request->size_id)
                ->get();
        $data = array('order' => $order);
        return $data;
    }
}
