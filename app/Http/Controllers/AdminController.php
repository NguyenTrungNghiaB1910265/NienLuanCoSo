<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
session_start();

class AdminController extends Controller
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

    public function index() {
        $meta_title = "Admin | N-SHOP";
        return view('admin_login')->with('meta_title',$meta_title);
    }

    public function show_dashboard() {
        $this->AuthLogin();
        $meta_title = "Home | N-SHOP";
        return view('admin.dashboard')->with('meta_title',$meta_title);
    }

    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Tài khoản và mật khẩu bạn nhập đã sai hoặc không tồn tại');
            return Redirect::to('/admin');
        }
    }

    public function logout() {
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function manage_customer() {
        $this->AuthLogin();
        $all_customer = Customer::orderBy('customer_id','DESC')->get();
        $manage_customer = view('admin.manage_customer')->with('all_customer',$all_customer);
        return view('admin_layout')->with('admin.manage_customer',$manage_customer);

    }

}
