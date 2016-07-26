@extends('admin.master')
@section('head.title', ' | Order Detail')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Order
            <small>Detail</small>
        </h1>
    </div>
    <div class="col-sm-6">
        <form class="navbar-form navbar-right" role="search">
          <input type="text" class="form-control" placeholder="Search..">
      </form>
    </div>
</div>
<div class="row">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">Order ID</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Image</th>
                <th class="text-center">Size ID</th>
                <th class="text-center">Color ID</th>
                <th class="text-center">Price Each</th>
                <th class="text-center">Quantity Order</th>
                <th class="text-center">Discount(%)</th>
                <th class="text-center">Payment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $item)
            <tr align="center">
                <td>{!! $item['order_id'] !!}</td>
                <td>{!! $item['pro_name'] !!}</td>
                <td><img src="{!! asset('upload/images/'.$product['image']) !!}" width="100"; height="100"></td> 
                <td>{!! $item['size_id'] !!}</td>
                <td>{!! $item['color_id'] !!}</td>
                <td>{!! number_format($item['price'],'0',',','.') !!}</td>
                <td>{!! $item['qty'] !!}</td>
                <td>{!! $product['discount'] !!}</td>
                <form method="post">
                <input type="hidden" value="{!! csrf_token() !!}" name="_token" />
                <td>
                    <input type="checkbox" name="status" id="status" {!! isset($data['status']) && $data['status']==1?"checked":"" !!}>
                    <br/>
                    <input type="submit" class="btn btn-primary" value="Change">
                </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.row -->

@stop