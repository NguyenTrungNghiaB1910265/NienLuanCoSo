<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout() {
        $meta_title = "Đăng nhập";
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_title', $meta_title); 
    }

    public function add_customer(Request $request) {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout() {
        $meta_title = "Thanh toán";
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_title', $meta_title);
    }

    public function save_checkout_customer(Request $request) {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function payment() {
        $meta_title = "Payment";
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_title', $meta_title);
    }

    public function logout_checkout() {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request) {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function order_place(Request $request) {
        $meta_title = "Payment";
        // $content = Cart::content();
        // echo $content;
        // Insert tbl_payment
        $payment_data = array();
        $payment_data['payment_method'] = $request->payment_option;
        $payment_data['payment_status'] = "Đang chờ xử lý";
        $payment_id = DB::table('tbl_payment')->insertGetId($payment_data);
        
        // Insert tbl_order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = "Đang chờ xử lý";
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        // Insert tbl_order_details
        $content = Cart::content();
        foreach($content as $value) {
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $value->id;
            $order_details_data['product_name'] = $value->name;
            $order_details_data['product_price'] = $value->price;
            $order_details_data['product_sales_quantity'] = $value->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
        }
        if($payment_data['payment_method']==1) {
            echo "ATM";
        } elseif ($payment_data['payment_method']==2) {
            // Sau khi dat hang xong se xoa gio hang hien tai va thong bao thanh cong
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_title', $meta_title);
        } else {
            echo "Paypal";
        }
        

        // return Redirect::to('/payment');
    }
    // public function AuthLogin() {
    //     $admin_id = Session::get('admin_id');
    //     if ($admin_id) {
    //         return Redirect::to('dasboard');
    //     } else {
    //         return Redirect::to('admin')->send();
    //     }
    // }

    // public function manage_order() {
    //     $this->AuthLogin();
        
    //     $all_order = DB::table('tbl_order')
    //         ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
    //         ->select('tbl_order.*','tbl_customers.customer_name')
    //         ->orderby('tbl_order.order_id','desc')->get();

    //     $manager_order = view('admin.manage_order')->with('all_order',$all_order);
    //     return view('admin_layout')->with('admin.manage_order',$manager_order);
    // }
}
