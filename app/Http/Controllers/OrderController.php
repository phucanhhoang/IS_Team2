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
    	$orders = Order::join('customers','orders.customer_id','=','customers.id')
                ->select('orders.id','orders.customer_id',DB::raw('SUM(orders.total_money) as total'),'orders.status',DB::raw('max(orders.created_at) as time'),'customers.name','customers.phone')
                ->groupBy('orders.id')
                ->orderBy('time','desc')
                ->get();

    	return view('admin.order.list',compact('orders'));
    }

    public function getDetail($id)
    {
        $detail = OrderDetail::join('products', 'orderdetails.pro_id','=','products.id')
                ->join('orders','orderdetails.order_id','=','orders.id')
                ->select('orderdetails.id','orderdetails.pro_id','orderdetails.pro_name','orderdetails.color_id','orderdetails.size_id','products.price','products.discount','products.image','orderdetails.qty','orderdetails.updated_at as time')
                ->where('orders.id','=',$id)
                ->orderBy('time','desc')
                ->get();

        $state = Order::select('customer_id','status')->where('id','=',$id)->get()->first();
        $sizes = Prosize::join('sizes', 'prosizes.size_id','=','sizes.id')
                ->select('sizes.id','sizes.size','prosizes.pro_id as product_id')
                ->get();

        $img_colors = ProColor::join('colors', 'procolors.color_id','=','colors.id')
                ->select('colors.id','colors.color','procolors.pro_id as product_id','procolors.color_id')
                ->get();

        $customers = Customer::join('orders','customers.id','=','orders.customer_id')
                ->join('districts','customers.district_id','=','districts.id')
                ->join('provinces','customers.province_id','=','provinces.id')
                ->select('orders.id','customers.id','customers.name','customers.address','districts.name as district','provinces.name as city','customers.phone')
                ->where('orders.id','=',$id)
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
        $details = OrderDetail::join('products', 'orderdetails.pro_id','=','products.id')
                ->join('orders','orderdetails.order_id','=','orders.id')
                ->select('orderdetails.pro_id','orderdetails.pro_name','products.id','products.price','products.discount','products.image','orderdetails.qty','orderdetails.size_id','orderdetails.color_id')
                ->where('orderdetails.id','=',$id)
                ->get()
                ->first();

        $detail_id = OrderDetail::select('order_id')->where('id','=',$id)->get()->first();

        $customer = Customer::join('orders','customers.id','=','orders.customer_id')
                ->join('districts','customers.district_id','=','districts.id')
                ->join('provinces','customers.province_id','=','provinces.id')
                ->select('orders.id','customers.id','customers.name','customers.address','districts.name as district','provinces.name as city','customers.phone')
                ->where('orders.id','=',$detail_id->order_id)
                ->get()
                ->first();

        $state = Order::select('customer_id','status')->where('id','=',$detail_id->order_id)->get()->first();

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
    	
    	return view('admin.order.edit',compact('details','customer','sizes','img_colors','state'));
    }

    public function postEdit($id, Request $request)
    {
        $detail_id = OrderDetail::select('order_id')->where('id','=',$id)->get()->first();

        $detail = OrderDetail::find($id);
        $detail->size_id = $request->size_id;
        $detail->color_id = $request->color_id;
        if ($request->qty>0) {
            $detail->qty = $request->qty;
        } else{
            return redirect()->back()->with(['level' => 'danger', 'message' => 'Sorry!! Cannot edit this order! Please check the quantity field.']);
        }

        $product = Product::where('id','=',$detail->pro_id)->get()->first();

    	$data = Order::where('id','=',$detail_id->order_id)
                ->get()
                ->first();
        $data->total_money = $product->price*$detail->qty*(1-$product->discount/100);
        $data->status = $request->status;

        // $customers = Customer::where('id','=',$data->customer_id)
        //         ->get();
    	$data->save();

    	$detail->save();
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

    public function postAdd(Request $request,OrderDetailRequest $detailrequest)
    {
        $order = new Order();
        $orderdetails = new OrderDetail();

        $product = Product::where('id','=',$detailrequest->pro_id)->get()->first();

        $custom = explode(" - ", $request->information);
        $customers = Customer::where('phone','=',$custom[1])->get()->first();
        
        $order->customer_id = $customers->id;
        $order->total_money = $product->price*$detailrequest->qty*(1-$product->discount/100);
        $order->status = 0;
        $order->save();

        $order_id = Order::select('id')->orderBy('id','desc')->get();

        foreach ($orderdetails as $orderdetail) {
            $orderdetail->order_id = $order_id->id;
            $orderdetail->pro_id = $detailrequest->pro_id;
            $orderdetail->color_id = $detailrequest->color_id;
            $orderdetail->size_id = $detailrequest->size_id;
            $orderdetail->pro_name = $product->pro_name;
            $orderdetail->price = $product->price;
            $orderdetail->qty = $detailrequest->qty;
            $orderdetail->save();
        }

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
        $customers = Customer::select('name','phone')->get();
        $data = array();
        foreach ($customers as $customer) {
            array_push($data, $customer->name.' - '.$customer->phone);
        }
        return $data;
    }

    
}
