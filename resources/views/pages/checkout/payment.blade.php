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

        
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $content = Cart::content(); Cart::setGlobalTax(1); Cart::setGlobalDiscount(0);?>
                    @foreach($content as $value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$value->options->image)}}" alt="" width="100"/></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value->name}}</a></h4>
                            <p>ID: {{$value->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($value->price).' VNĐ'}}</p>
                        </td>
                        <td class="cart_quantity" width="50">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart')}}" method="POST"> {{csrf_field()}}
                                    <p>{{$value->qty}}</p>
                                    <input type="hidden" value="{{$value->rowId}}" name="cart_rowId">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($value->price * $value->qty).' VNĐ'}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart',$value->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach	
                </tbody>
            </table>
        </div>

        <br>
        <h4 style="margin: 4%;">Chọn hình thức thanh toán</h4>
        <form action="{{URL::to('/order-place')}}" method="POST"> {{csrf_field()}}
            <div class="payment-options">
                <span>
                    <label><input type="radio" name="payment_option" value="1"> Thanh toán qua thẻ ATM</label>
                </span>
                <span>
                    <label><input type="radio" name="payment_option" value="2"> Tiền mặt</label>
                </span>
                <span>
                    <label><input type="radio" name="payment_option" value="3"> Paypal</label>
                </span>
                <button type="submit" class="btn btn-default check_out" href="">Đặt hàng</button>
            </div>
        </form>
    </div>
</section> <!--/#cart_items-->

@endsection