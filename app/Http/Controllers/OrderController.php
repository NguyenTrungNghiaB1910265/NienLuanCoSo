<?php

namespace App\Http\Controllers;
use DB;
use App\Order;
use App\Category;
use App\Brand;
use App\Customer;
use Cart;
use App\Http\Requests;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
session_start();

class OrderController extends Controller
{

    // Kiem tra nguoi dung da dang nhap chua
    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dasboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function manage_order() {
        $this->AuthLogin();
        
        $all_order = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')
            ->orderby('tbl_order.order_id','desc')->get();

        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }

    public function view_order($orderId) {
        $this->AuthLogin();
        
        $order_by_id = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
            ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
            ->where('tbl_order.order_id', $orderId)
            ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')
            ->get();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    }

    public function confirm_order($confirmId) {
        $confirm = Order::where('order_id', $confirmId)->update(['order_status'=>'Đã xử lý']);
        return back();
    }

    public function login_order() {
        $meta_title = "Đăng nhập";
        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.order.login_customer_order')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_title', $meta_title); 
    }

    public function login_customer_order(Request $request) {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = Customer::where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/show-customer-order/'.$result->customer_id);
        } else {
            return Redirect::to('/login-order');
        }
    }

    public function show_customer_order($customerId) {
        $meta_title = "Đơn hàng của bạn";

        $cate_product = Category::where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderby('brand_id','desc')->get();
        
        // $order_by_customer_id = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        //     ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        //     ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        //     ->where('tbl_customers.customer_id', $customerId)
        //     ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')
        //     ->get();
        
        // return view('pages.order.show_customer_order')->with('category',$cate_product)->with('brand',$brand_product)->with('order_by_customer_id',$order_by_customer_id)->with('meta_title',$meta_title);

        $all_order = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
            ->where('tbl_customers.customer_id', $customerId)
            ->select('tbl_order.*','tbl_customers.customer_name')
            ->orderby('tbl_order.order_id','desc')->get();

        return view('pages.order.show_customer_order')->with('all_order',$all_order)->with('category',$cate_product)->with('brand',$brand_product)->with('meta_title',$meta_title);
    }

}
