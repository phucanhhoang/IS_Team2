<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/25/2016
 * Time: 1:45 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;
use App\Size;

class CartController extends Controller
{
    public function add(Request $request){

        $rowId = \Cart::search(array('options' => array(
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'product_id' => $request->product_id
        )));
        if($rowId){
            $cart = \Cart::get($rowId[0]);
            \Cart::update($rowId[0], $cart->qty + $request->quantity);
        }
        else{
            $product = Product::find($request->product_id);
            $color = Color::find($request->color_id);
            $size = Size::find($request->size_id);

            \Cart::add(array(
                'id' => \Cart::count(false) + 1,
                'name' => $product->pro_name,
                'qty' => $request->quantity,
                'price' => $product->price,
                'discount' => $product->discount * $product->price / 100,
                'options' => array(
                    'size_id' => $request->size_id,
                    'color_id' => $request->color_id,
                    'product_id' => $request->product_id,
                    'color' => $color->color,
                    'size' => $size->size,
                    'image' => $product->image
                )
            ));
        }

        return \Cart::content();
    }

    public function delete(Request $request){
        $check = \Cart::remove($request->id);
        if ($check) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function change(Request $request){
        $check = \Cart::update($request->id, $request->quantity);
        $cart = \Cart::get($request->id);

        if($check) {
            $data = array(
                'msg' => 'true',
                'count' => \Cart::count(),
                'money' => ($cart->price - $cart->discount) * $request->quantity,
                'subtotal' => \Cart::subtotal()
            );
            return $data;
        }
        else
            return 'false';
    }
}