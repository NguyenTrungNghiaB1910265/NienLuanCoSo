@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Đặt hàng thành công</li>
            </ol>
        </div><!--/breadcrums-->

        
        <div class="review-payment">
            <h2 style="color: green;">Đơn hàng của bạn đã được đặt thành công. Cảm ơn bạn đã đặt hàng tại N-SHOP's website!</h2>
        </div>
       

    </div>
</section> <!--/#cart_items-->

@endsection