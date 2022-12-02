@extends('layout')
@section('content')

<div class="features_items"  style="background-color:white;"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach($all_product as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                        <h4 style="height: 30px;">{{$product->product_name}}</h4>
                        <h2>{{number_format($product->product_price).' VNĐ'}}</h2>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h4>{{$product->product_name}}</h4>
                            <h2>{{number_format($product->product_price).' VNĐ'}}</h2>
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart">Xem chi tiết</a>
                            <form action="{{URL::to('/save-cart')}}" method="POST">{{ csrf_field() }}
                                <input name="quantity" type="hidden" min="1" value="1" />
                                <input name="product_id_hidden" type="hidden" value="{{$product->product_id}}" />
                                    <button type="submit" class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Thêm vào giỏ
                                    </button>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div><!--features_items-->

<!--category-tab-->


<!--recommended_items-->


@endsection