@extends('admin.master')
@section('head.title', ' | Product List')
@section('content')
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
      <li><a href="{!! url('admin/product') !!}">Product</a></li>
      <li class="active">View</li>
    </ol>
</div>
<div class="row">
    <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Product
        <small>Details</small>
    </h1>
    <a href="{!! route('admin.product.edit',$product->id) !!}" class="btn btn-warning" style="float:left; margin-right: 10px;"><i class="fa fa-pencil"></i> Edit </a>
    {!! Form::open(['route' => ['admin.product.destroy', $product->id], 'method' => 'DELETE' ]) !!}
        <button type="submit" class="btn btn-danger" onclick="return deletePro()">
            <i class="fa fa-trash-o"></i> Delete
        </button>
    {!! Form::open() !!}
</div>
@include('admin.message')
<br>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <table class="table" style="border: 1px solid #d1d1e0;">
            <tr>
                <td style="min-width: 200px">
                    <label for="pro_name">Product Name</label>
                </td>
                <td>{!! $product->pro_name !!}</td>
            </tr>
            <tr>
                <td><label for="pro_code">Product Code</label></td>
                <td>{!! $product->pro_code !!}</td>
            </tr>
            <tr>
                <td><label for="pro_code">Category</label></td>
                <td>
                    <?php
                        $cat = DB::table('categories')->where('id', '=', $product->cat_id)->first();
                        if($cat)
                            echo $cat->cat_title;
                        else 
                            echo "none";

                    ?>
                </td>
            </tr>
            <tr>
                <td><label for="price">Price</label></td>
                <td>{!! number_format($product->price, 0, ',', '.') !!} VNĐ</td>
            </tr>
            <tr>
                <td><label for="discount">Discount</label></td>
                <td>
                    {!! $product->discount !!} %
                </td>
            </tr>
            
            <tr>
                <td><label for="image">Image</label></td>
                <td><img src="{!! url('upload/images',$product->image) !!}" alt="" width="250"; height="250"></td>
            </tr>
            <tr>
                <td><label for="image">Detail Images</label></td>
                <td>
                    @foreach($images as $image)
                        <img src="{!! asset('upload/images/details/'.$image->images) !!}" style="width: 80px; height: 80px" class="img-thumbnail">  
                    @endforeach
                </td>
            </tr>

             <tr>
                <td><label for="color">Color</label></td>
                <td>
                    <div class="form-group">
                        <div class="form-group mausac">
                              <?php
                                $stt = 0;
                                foreach($colors as $color){
                                    $stt++;
                                ?>
                              <input type="checkbox" class='chk_color' value="{{$color->id}}" id="{{'ms-check'.$stt}}" name="colors[]" disabled="disabled" />
                                <label for="{{'ms-check'.$stt}}" style="<?php echo 'background-color:'.$color->color ?>"></label>
                                <?php } ?>
                              </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><label for="size">Size</label></td>
                <td>
                    @foreach($sizes as $size)
                        {!! $size->size !!},   
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><label for="description">Description</label></td>
                <td>{!! $product->full_des !!}</td>
            </tr>
            <tr>
                <td><label for="created">Created at</label></td>
                <td>{!! date('Y-m-d', strtotime($product->created_at)) !!}</td>
            </tr>
            <tr>
                <td><label for="updated">Last updated</label></td>
                <td>{!! date('Y-m-d', strtotime($product->updated_at)) !!}</td>
            </tr>
        </table>
    </div>
</div>
<!-- /.row -->
@stop
