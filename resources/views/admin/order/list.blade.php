@extends('admin.master')
@section('head.title', ' | Order List')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Order
            <small>List</small>
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
                <th class="text-center">STT</th>
                <th class="text-center">Order ID</th>
                <th class="text-center">Customer ID</th>
                <th class="text-center">Total Money</th>
                <th class="text-center">Status</th>
                <th class="text-center">View</th>
                <th class="text-center">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt=0; ?>
            @foreach($orders as $order)
            <?php $stt++; ?>
            <tr align="center">
                <td>{!! $stt !!}</td>
                <td>{!! $order->id !!}</td>
                <td>{!! $order->customer_id !!}</td>
                <td>{!! number_format($order->total_money,'0',',','.') !!}</td>
                <td>{!! ($order->status==0)?'Đang chờ':'Đã thanh toán' !!}</td>
                <td><i class="fa fa-eye fa-fw"></i><a href="{!! url('admin/order/detail') !!}/{!! $order->id !!}">View</a></td>
                <td><i class="fa fa-pencil fa-fw"></i><a href="{!! url('admin/order/edit') !!}/{!! $order->id !!}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.row -->

@stop