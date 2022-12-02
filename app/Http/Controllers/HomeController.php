<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use App\Brand;
use App\Product;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class HomeController extends Controller
{
    public function index() {

        $meta_title = "Home | N-SHOP";

        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();

        $all_product = Product::where('product_status','1')->orderby('product_id','desc')->get();

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_title',$meta_title);
        
    }

    public function search(Request $request) {
        $meta_title = "Tìm kiếm | N-SHOP";
        $keywords = $request->keywords_submit;
        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();

        $search_product = Product::where('product_name','like','%'.$keywords.'%')->get();

        return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('meta_title',$meta_title);
    }
}
