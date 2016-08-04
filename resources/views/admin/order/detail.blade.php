@extends('admin.master')
@section('head.title', ' | Order Detail')
@section('content')

<!-- customer -->
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Customer
            <small>Info</small>
        </h1>
    </div>
</div>
<div class="row">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">Customer ID</th>
                <th class="text-center">Customer Name</th>
                <th class="text-center">Address</th>
                <th class="text-center">Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr align="center">
                <td>{!! $customer['id'] !!}</td>
                <td>{!! $customer['name'] !!}</td>
                <td>{!! $customer['address'].' - '.$customer['district'].' - '.$customer['city'] !!}</td>
                <td>{!! $customer['phone'] !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- end customer -->

<!-- order detail -->
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Order
            <small>Detail</small>
        </h1>
    </div>
    <div class="col-sm-6">
        <form class="navbar-form navbar-right" method="post" style="margin-top:30px;">
            <input type="hidden" value="{!! csrf_token() !!}" name="_token" />
            <label for="status" style="margin-top:5px; font-size: medium;">Status : </label>
            {!! Form::select('status', array(
                '0' => 'Pending',
                '1' => 'Proccessing',
                '2' => 'Complete',
                '3' => 'Canceled' 
                ), $state['status'], ['class' => 'form-control']) 
        !!}
            <input type="submit" class="btn btn-primary" value="Change">
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
                <th class="text-center">Size</th>
                <th class="text-center">Color</th>
                <th class="text-center">Price Each</th>
                <th class="text-center">Quantity Order</th>
                <th class="text-center">Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $item)
            <?php 
                $item['price'] = $item['price']*(1 - $item['discount']/100);
            ?>
            <tr align="center">
                <td>{!! $item['id'] !!}</td>
                <td>{!! $item->pro_name !!}</td>
                <td><img src="{!! asset('upload/images/'.$item['image']) !!}" width="75"; height="75"></td>
                <td>
                @foreach($sizes as $size)
                    {!! ($item['pro_id']==$size['product_id'] && $item['size_id']==$size['id']) ? $size['size']:'' !!}
                @endforeach
                </td>
                <td>
                    <?php //dd($img_colors) ?>
                @foreach($img_colors as $color)
                    @if($item['pro_id']==$color['product_id'] && $item['color_id']==$color['id'])
                        <img src="{!! asset('upload/images/colors/'.$color['color']) !!}">
                    @endif
                @endforeach
                </td>
                <td>{!! number_format($item['price'],'0',',','.') !!}</td>
                <td>{!! $item['qty'] !!}</td>
                <td>{!! $item['time'] !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- end order detail -->
<!-- /.row -->

@stop