<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderDetailRequest;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Prosize;
use App\Size;
use App\Customer;
use App\Image;
use App\Color;

use DB;

class OrderController extends Controller
{
    public function getList()
    {
    	$orders = Order::join('customers','orders.customer_id','=','customers.id')
                ->select('orders.id','orders.customer_id',DB::raw('SUM(orders.total_money) as total'),'orders.status',DB::raw('max(orders.created_at) as time'),'customers.name','customers.phone')
                ->groupBy('orders.id')
                ->orderBy('time','asc')
                ->get();

    	return view('admin.order.list',compact('orders'));
    }

    public function getDetail($id)
    {
        $detail = OrderDetail::join('products', 'orderdetails.pro_id','=','products.id')
                ->join('orders','orderdetails.order_id','=','orders.id')
                ->select('orderdetails.pro_id','orderdetails.pro_name','orderdetails.color_id','orderdetails.size_id','products.price','products.discount','products.image','qty','orderdetails.updated_at as time','orders.id')
                ->where('orders.id','=',$id)
                ->orderBy('time','desc')
                ->get();

        $state = Order::select('customer_id','status')->where('id','=',$id)->get()->first();
        $sizes = Prosize::join('sizes', 'prosizes.size_id','=','sizes.id')
                ->select('sizes.id','sizes.size','prosizes.pro_id as product_id')
                ->get();

        $img_colors = Image::join('colors', 'images.color_id','=','colors.id')
                ->select('colors.id','colors.color','images.pro_id as product_id','images.color_id')
                ->get();

        $customers = Customer::join('orders','customers.id','=','orders.customer_id')
                ->select('orders.id','customers.id','customers.name','customers.address','customers.district','customers.city','customers.phone')
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
    	return redirect()->route('admin.order.list');
    }

    public function getEdit($id)
    {
    	$detail = OrderDetail::where('order_id','=',$id)->get()->first();
    	$product_id = OrderDetail::where('order_id',$id)->get()->first();
    	$product = Product::select('id','pro_name','price','discount','image')->where('id','=',$product_id->pro_id)->get()->first();
        $sizes = Size::select('id','size')->get();
        $colors = OrderDetail::select('color_id')->distinct()->get();
    	$data = Order::find($id);
    	return view('admin.order.edit',compact('detail','data','product','sizes','colors'));
    }

    public function postEdit($id, Request $request)
    {
    	$detail = OrderDetail::where('order_id','=',$id)->get()->first();
    	$detail->size_id = $request->size_id;
    	$detail->color_id = $request->color_id;
    	$detail->qty = $request->qty;

    	$data = Order::find($id);
    	$data->save();

    	$detail->save();
    	return redirect()->route('admin.order.list');
    }

    public function getAdd()
    {
        $customers = Customer::select('id','name')->get();
        $products = Product::select('id','pro_name')->get();
        $sizes = Size::select('id','size')
                ->groupBy('size')
                ->get();
        $img_colors = Image::join('colors', 'images.id','=','colors.id')
                ->select('colors.id','colors.color','images.color_id')
                ->get();
    	return view('admin.order.add',compact('customers','products','sizes','img_colors'));
    }

    public function postAdd(OrderRequest $orderrequest, OrderDetailRequest $detailrequest)
    {
        $order = new Order();
        $orderdetail = new OrderDetail();

        $product = Product::where('id',$detailrequest->pro_id)->get()->first();

        $order->customer_id = $orderrequest->customer_id;
        $order->total_money = $product->price*$detailrequest->qty*(1-$product->discount/100);
        $order->status = 0;
        $order->save();

        $order_id = Order::select('id')->orderBy('id','desc')->get()->first();

        $orderdetail->order_id = $order_id->id;
        $orderdetail->pro_id = $detailrequest->pro_id;
        $orderdetail->color_id = $detailrequest->color_id;
        $orderdetail->size_id = $detailrequest->size_id;
        $orderdetail->pro_name = $product->pro_name;
        $orderdetail->price = $product->price;
        $orderdetail->qty = $detailrequest->qty;
        $orderdetail->save();

        return redirect()->route('admin.order.list');
    }
}
