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
    <a href="{!! route('admin.product.edit',$product->id) !!}" class="btn btn-primary" style="float:left"><i class="fa fa-eye"></i> Edit </a>
    {!! Form::open(['route' => ['admin.product.destroy', $product->id], 'method' => 'DELETE' ]) !!}
        <button type="submit" class="btn btn-danger" onclick="return deletePro()">
            <i class="fa fa-trash-o"></i> Delete
        </button>
    {!! Form::open() !!}
</div>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        @if(Session::has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success:</strong> {!! Session::get('message') !!}
            </div>
        @endif
    </div>
</div>

<br>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <table class="table table-hover">
            <tr>
                <td style="min-width: 200px"><label for="pro_name">Product Name</label></td>
                <td>{!! $product->pro_name !!}</td>
            </tr>
            <tr>
                <td><label for="pro_code">Product Code</label></td>
                <td>{!! $product->pro_code !!}</td>
            </tr>
            <tr>
                <td><label for="price">Price</label></td>
                <td>{!! number_format($product->price, 0, ',', '.') !!} VNĐ</td>
            </tr>
            <tr>
                <td><label for="discount">Discount</label></td>
                <td>{!! $product->discount !!}%</td>
            </tr>
            <tr>
                <td><label for="size">Size</label></td>
                <td>
                    @foreach($sizes as $size)
                        {!! $size->size !!}   
                    @endforeach
                </td>
            </tr>
             <tr>
                <td><label for="color">Color</label></td>
                <td>
                    @foreach($colors as $color)
                        <img src="{!! asset('upload/images/colors/'.$color->color) !!}" style="width: 25px; height: 25px">   
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><label for="image">Image</label></td>
                <td><img src="{!! url('upload/images',$product->image) !!}" alt="" width="50"; height="50"></td>
            </tr>
            <tr>
                <td><label for="description">Description</label></td>
                <td>{!! $product->full_des !!}</td>
            </tr>
            <tr>
                <td><label for="created">Created at</label></td>
                <td>{!! date('M j, Y', strtotime($product->created_at)) !!}</td>
            </tr>
            <tr>
                <td><label for="updated">Last updated</label></td>
                <td>{!! date('M j, Y', strtotime($product->updated_at)) !!}</td>
            </tr>
        </table>
    </div>
</div>
<!-- /.row -->

@stop
@section('body.js')
    <script type="text/javascript" src="{!! asset('admin/javascript/myscript.js') !!}"></script>
@stop