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

class OrderController extends Controller
{
    public function getList()
    {
    	$orders = Order::select('id','customer_id','total_money','status')->orderBy('id','desc')->get();
    	return view('admin.order.list',compact('orders'));
    }

    public function getDetail($id)
    {
    	$detail = OrderDetail::where('order_id','=',$id)->get();
    	$product_id = OrderDetail::where('order_id',$id)->get()->first();
    	$product = Product::select('id','pro_name','price','discount','image')->where('id','=',$product_id->pro_id)->get()->first();
    	$data = Order::find($id);
    	return view('admin.order.detail',compact('detail','data','product'));
    }

    public function postChange($id, Request $request)
    {
    	$data = Order::find($id);
    	$data->status = $request->status=="on" ? 1 : 0;
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
    	$data->status = $request->status=="on" ? 1 : 0;
    	$data->save();

    	$detail->save();
    	return redirect()->route('admin.order.list');
    }

    public function getAdd()
    {
        $orders = Order::select('customer_id')->distinct()->get();
        $products = Product::select('id','pro_name')->get();
        $sizes = Size::select('id','size')->get();
        $colors = OrderDetail::select('color_id')->distinct()->get();
    	return view('admin.order.add',compact('orders','products','sizes','colors'));
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
