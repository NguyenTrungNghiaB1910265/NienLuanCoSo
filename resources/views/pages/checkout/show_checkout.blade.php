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
            @if(Session::get('error_quantity'))
            <p style="color: red;">{{Session::get('error_quantity')}}!!!!!</p>
            @endif
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-10 clearfix">
                    <div class="bill-to">
                        <p>Thông tin đặt hàng</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save-checkout-customer')}}" method="POST"> {{ csrf_field() }}
                                Email:<input type="email" name="shipping_email" placeholder="Email" value="nghia@gmail.com">
                                Tên:<input type="text" name="shipping_name" placeholder="Họ tên" value="Nghia Nguyen">
                                Địa chỉ giao hàng:<input type="text" name="shipping_address" placeholder="Địa chỉ" value="Đường 3/2, Xuân Khánh, Ninh Kiều, Cần Thơ">
                                Số điện thoại:<input type="text" name="shipping_phone" placeholder="Số điện thoại" value="0999123123">
                                Ghi chú:<textarea name="shipping_note"  placeholder="Vui lòng điền ghi chú cho đơn hàng của bạn tại đây" rows="16"></textarea>
                                <button type="submit" class="btn btn-default check_out" href="">Lưu đơn hàng</button>
                            </form>
                        </div>
                       
                    </div>
                </div>
                				
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection