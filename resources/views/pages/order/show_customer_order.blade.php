@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Đơn hàng của bạn</li>
            </ol>
        </div><!--/breadcrums-->

        @foreach($all_order as $value_order)
        <div class="register-req col-sm-9">
            
            <table>
                <tr><td>Mã đơn: {{$value_order->order_id}}</td> </tr>
                <tr><td>Tên người đặt: {{$value_order->customer_name}}</td> </tr>
                <tr><td>Số điện thoại: {{$value_order->shipping_phone}}</td> </tr>
                <tr><td>Địa chỉ giao hàng: {{$value_order->shipping_address}}</td> </tr>
                <tr><td>Sản phẩm: <button type="button" data-toggle="modal" data-target="#exampleModalCenter">Xem chi tiết</button></td></tr>
                <tr><td>Số tiền cần thanh toán: {{$value_order->order_total}}</td></tr>
                <tr><td>Trạng thái đơn hàng: 
                                @if($value_order->order_status=="Đang chờ xử lý")
                                <span style="color: orange;">{{$value_order->order_status}} <i class="fa fa-spinner"></i></span>
                                @else
                                <span style="color: green;">{{$value_order->order_status}} <i class="fa fa-check"></i></span>
                                @endif
                            </td></tr>
                <tr><td>Thời gian đặt hàng: {{$value_order->created_at}}</td></tr>
            </table>
            
        </div>
        
        @endforeach
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sản phẩm trong đơn hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @foreach($all_order as $value_order)
                <p>{{$value_order->product_name}}</p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

    </div>
</section> <!--/#cart_items-->

@endsection