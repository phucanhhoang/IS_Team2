<?php
/**
 * Created by IntelliJ IDEA.
 * User: phuca
 * Date: 8/10/2016
 * Time: 9:23 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Customer;
use DB;

class UserController extends Controller
{
    public function info(){
        $customer = Customer::find(\Auth::user()->userable_id);
        $provinces = DB::table('provinces')->orderBy('name')->get();
        $districts = DB::table('districts')->where('province_id', $customer->province_id)->get();
        $district = mb_convert_case(DB::table('districts')->where('id', $customer->district_id)->first()->name, MB_CASE_TITLE, "UTF-8");
        $province = mb_convert_case(DB::table('provinces')->where('id', $customer->province_id)->first()->name, MB_CASE_TITLE, "UTF-8");

        return view('pages.user-info', compact('customer', 'provinces', 'districts', 'district', 'province'));
    }
    public function secure(){
        return view('pages.user-secure');
    }
    public function order(){
        return view('pages.user-order');
    }
}