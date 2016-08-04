<?php namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $pros = Product::take(8)->get();
        $cat_parents = Category::where('parent_id', 0)->take(3)->get();

        return view('pages.home', compact('pros', 'cat_parents'));
    }

    public function loadProduct(Request $request){
        $products = Product::skip(8 * $request->times)->take(8)->get();
        $next = Product::skip(8 * ($request->times + 1))->take(8)->get();

        if($next->count() > 0 || $products->count() > 0){
            $data = array(
                'show_loading' => 'true',
                'products' => $products
            );
        }
        else{
            $data = array(
                'show_loading' => 'false',
                'products' => $products
            );
        }

        return $data;
    }


//-------------------Admin zone------------------------//

    public function adminHomePage()
    {
        return view('admin.home');
    }
}
