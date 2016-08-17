<?php
/**
 * Created by IntelliJ IDEA.
 * User: phuca
 * Date: 8/10/2016
 * Time: 9:23 AM
 */

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Customer;
use DB;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
    public function info(){
        $customer = \Auth::user();
        $provinces = DB::table('provinces')->orderBy('name')->get();
        $province = '';
        $district = '';
        $districts = array();
        if($customer->province_id != 0){
            $districts = DB::table('districts')->where('province_id', $customer->province_id)->get();
            $province = mb_convert_case(DB::table('provinces')->where('id', $customer->province_id)->first()->name, MB_CASE_TITLE, "UTF-8");
        }
        if($customer->district_id != 0)
            $district = mb_convert_case(DB::table('districts')->where('id', $customer->district_id)->first()->name, MB_CASE_TITLE, "UTF-8");

        return view('pages.user-info', compact('customer', 'provinces', 'districts', 'district', 'province'));
    }
    public function save(CustomerRequest $request){
        try {
            $customer = Auth::user();
            if($request->phone != $customer->phone){
                $count = Customer::where('phone', $request->phone)->count();
                if(!$count > 0){
                    $customer->phone = $request->phone;
                } else{
                    return redirect('user/info')->withErrors('Số điện thoại đã tồn tại');
                }
            }
            $customer->name = $request->name;
            $customer->province_id = $request->province;
            $customer->district_id = $request->district;
            $customer->address = $request->address;
            $customer->save();

            return redirect('user/info')->with('msg', 'Cập nhật thông tin cá nhân thành công');
//            dd($customer);

        }catch(\Exception $e){
            dd($e);
        }
    }
    public function secure(){
        return view('pages.user-secure');
    }
    public function changePass(Request $request){
        $rules = [
            'password_old' => 'required',
            'password' => 'required|confirmed|min:8'

        ];
        $messages = [
            'password_old.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.confirmed' => 'Mật khẩu chưa khớp',
            'password.min' => 'Mật khẩu phải từ 8 ký tự trở lên'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return redirect('user/secure')->withErrors($validator);
        }

        if(Hash::check($request->password_old, Auth::user()->password)){
            Auth::user()->password = Hash::make($request->password);
            $check = Auth::user()->save();
            if($check)
                return redirect('user/secure')->with('msg', 'Đổi mật khẩu thành công');
            else
                return redirect('user/secure')->withErrors('Có lỗi xảy ra. Vui lòng thử lại sau!');
        }
        else{
            return redirect('user/secure')->withErrors('Mật khẩu không chính xác');
        }
    }
    public function order(){
        $date_from = new \DateTime('-1 months');
        $date_to = new \DateTime();

        $orders = Order::where('customer_id', Auth::user()->id)
            ->whereBetween('created_at', [$date_from, $date_to])
            ->get();

        if($orders->count() > 0)
            return view('pages.user-order', compact('orders'));
        else
            return view('pages.user-order');
    }
    public function getOrderDetail(Request $request){
        $order_detail = OrderDetail::join('colors', 'colors.id', '=', 'orderdetails.color_id')
            ->join('sizes', 'sizes.id', '=', 'orderdetails.size_id')
            ->select('order_id as id', 'pro_id', 'pro_name', 'pro_image as image', 'color', 'size', 'price', 'qty')
            ->where('order_id', $request->order_id)->get();

        return $order_detail;
    }
    public function searchOrder(Request $request){
        $date_from = date_create_from_format('d/m/Y', $request->xemtu);
        $date_to = date_create_from_format('d/m/Y', $request->xemden);
        $status = $request->status;
        $orders = Order::where('customer_id', Auth::user()->id)
            ->whereBetween('created_at', [$date_from, $date_to]);
        if($status != '')
            $orders = $orders->where('status', $status);

        return $orders->get();
    }
}