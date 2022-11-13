@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
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
						<?php $content = Cart::content(); Cart::setGlobalTax(1); Cart::setGlobalDiscount(1);?>
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
										<input class="cart_quantity_input" type="number" name="cart_quantity" value="{{$value->qty}}">
										<input type="hidden" value="{{$value->rowId}}" name="cart_rowId">
										<button type="submit" value="Cap nhat" name="update_quantity" class="btn btn-default btn-sm">Cập nhật</button>
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
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng số sản phẩm <span>{{Cart::count()}}</span></li>
							<li>Tiền sản phẩm <span>{{Cart::subtotal(0).' VNĐ'}}</span></li>
							<li>Thuế (1%) <span>{{Cart::tax(0).' VNĐ'}}</span></li>
							<li>Giảm giá (1%) <span>{{Cart::discount(0).' VNĐ'}}</span></li>
							<li>Phí vận chuyển <span>Miễn phí	</span></li>
							<li>Tổng tiền thanh toán <span>{{Cart::total(0).' VNĐ'}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Thanh toán</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->


@endsection