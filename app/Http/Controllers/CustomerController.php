<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CustomerRequest;
use App\Customer;
use App\Order;
use DB;

class CustomerController extends Controller
{
    public function getList()
    {
        $customers = Customer::join('districts','customers.district_id','=','districts.id')
                ->join('provinces','customers.province_id','=','provinces.id')
                ->select('customers.id','customers.name','customers.address','districts.name as district','provinces.name as city','customers.phone')
                ->get();
        return view('admin.customer.list',compact('customers'));
    }

    public function getEdit($id)
    {
        $customer = Customer::join('districts','customers.district_id','=','districts.id')
                ->join('provinces','customers.province_id','=','provinces.id')
                ->select('customers.id','customers.name','customers.address','districts.name as district','provinces.name as city','customers.phone')
                ->where('customers.id','=',$id)
                ->get()
                ->first();
        return view('admin.customer.edit',compact('customer','id'));
    }

    public function postEdit($id, Request $request)
    {
        $customer = Customer::join('districts','customers.district_id','=','districts.id')
                ->join('provinces','customers.province_id','=','provinces.id')
                ->select('customers.id','customers.name','customers.address','districts.name as district','provinces.name as city','customers.phone')
                ->where('customers.id','=',$id)
                ->get()
                ->first();
        $customer->name = $request->customer_name;
        $customer->address = $request->address;
        $customer->district = $request->district;
        $customer->city = $request->city;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('admin.customer.list')->with(['level' => 'success', 'message' => 'Success!!! Complete edit customer!!']);
    }

    public function getAdd()
    {
//        $customer = Customer::join('districts','customers.district_id','=','districts.id')
//                ->join('provinces','customers.province_id','=','provinces.id')
//                ->select('customers.id','customers.name','customers.address','districts.name as district','provinces.name as city','customers.phone')
//                ->get();
        $provinces = DB::table('provinces')->get();
        return view('admin.customer.add', compact('provinces'));
    }

    public function postAdd(CustomerRequest $request)
    {
    	$customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->district_id = $request->district;
        $customer->province_id = $request->province;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('admin.customer.list')->with(['level' => 'success', 'message' => 'Success!!! Complete add customer!!']);
    }

    public function getDelete($id)
    {
        $customer = Customer::find($id);
        $customer->delete($id);
        $orders = Order::where('customer_id','=',$id)->get();
        foreach ($orders as $order) {
            $order->delete($order->id);
        }

        return redirect()->route('admin.customer.list')->with(['level' => 'success', 'message' => 'Success!!! Complete delete customer!!']);
    }
}
