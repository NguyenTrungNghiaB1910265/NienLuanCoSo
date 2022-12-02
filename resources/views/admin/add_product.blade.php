@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm sản phẩm
                        </header>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="product_name"  id="slug" placeholder="Nhập tên sản phẩm" data-validation="length" data-validation-length="min5" data-validation-error-msg="Vui lòng điền tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                                        <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="product_price"  id="slug" placeholder="Nhập giá sản phẩm" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng điền giá sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                        <input type="text"  class="form-control"  onkeyup="ChangeToSlug();" name="product_quantity"  id="slug" placeholder="Nhập số lượng sản phẩm" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng điền số lượng sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                        <input type="file" class="form-control" onkeyup="ChangeToSlug();" name="product_image"  id="slug" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="ckeditor_desc_product" placeholder="Nhập mô tả sản phẩm"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="ckeditor_content_product" placeholder="Nhập nội dung sản phẩm"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Danh mục</label>
                                        <select name="product_cate" class="form-control input-sm m-bot15">
                                            @foreach($cate_product as $key => $cate)
                                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thương hiệu</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                            @foreach($brand_product as $key => $brand)
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Hiển thị</label>
                                        <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>
                                
                                    <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection