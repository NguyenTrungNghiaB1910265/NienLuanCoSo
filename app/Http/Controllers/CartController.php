<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Category;
use App\Brand;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{

    public function save_cart(Request $request) {
        
        $productId = $request->product_id_hidden;
        $quantity = $request->quantity;
        $product_info = Product::where('product_id',$productId)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id'] = $productId;
        $data['name'] = $product_info->product_name;
        $data['qty'] = $quantity;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);

        return Redirect::to('/show-cart');
        
    }

    public function show_cart() {
        $meta_title = "Giỏ hàng | N-SHOP";
        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_title',$meta_title);
    }

    public function delete_to_cart($rowId) {
        Cart::remove($rowId);
        return Redirect::to('/show-cart');
    }

    public function update_cart(Request $request) {
        $rowId = $request->cart_rowId;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }

}
