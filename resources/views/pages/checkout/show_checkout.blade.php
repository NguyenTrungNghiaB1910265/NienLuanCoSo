@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->


        <div class="register-req">
            <p>Vui lòng đăng nhập để thanh toán và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-10 clearfix">
                    <div class="bill-to">
                        <p>Thông tin đặt hàng</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save-checkout-customer')}}" method="POST"> {{ csrf_field() }}
                                <input type="email" name="shipping_email" placeholder="Email">
                                <input type="text" name="shipping_name" placeholder="Họ tên">
                                <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_note"  placeholder="Vui lòng điền ghi chú cho đơn hàng của bạn tại đây" rows="16"></textarea>
                                <button type="submit" class="btn btn-default check_out" href="">Lưu đơn hàng</button>
                            </form>
                        </div>
                       
                    </div>
                </div>
                				
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

@endsection