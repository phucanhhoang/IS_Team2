@extends('admin.master')
@section('head.title', ' | Order List')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Order
            <small>List</small>
        </h1>
    </div>
</div>
<div class="row">
    <table class="table table-striped table-bordered table-hover" id="dataTable">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Customer Name</th>
                <th class="text-center">Total Money</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Status</th>
                <th class="text-center">Date</th>
                <th class="text-center">View</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt=0; ?>
            @foreach($orders as $order)
            <?php $stt++; ?>
            <tr align="center">
                <td>{!! $stt !!}</td>
                <td>{!! $order->customer_name !!}</td>
                <td>{!! number_format($order->total,'0',',','.') !!}</td>
                <td>{!! $order->phone !!}</td>
                <td>{!! $order->status==0?'Pending':($order->status==1?'Processing':($order->status==2?'Complete':($order->status==3?'Canceled':''))) !!}</td>
                <td>{!! $order->time !!}</td>
                <td><i class="fa fa-eye fa-fw"></i><a href="{!! url('admin/order/detail') !!}/{!! $order->id !!}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.row -->

@stop