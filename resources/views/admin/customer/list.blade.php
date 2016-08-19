@extends('admin.master')
@section('head.title', ' | Customer List')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Customer
            <small>List</small>
        </h1>
    </div>
</div>
<div class="row">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Customer Name</th>
                <th class="text-center">Address</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt=0; ?>
            @foreach($customers as $customer)
            <?php $stt++; ?>
            <tr align="center">
                <td>{!! $stt !!}</td>
                <td>{!! $customer->name !!}</td>
                <td>
                    {!! $customer->city == '' ? '' : $customer->address.' - '.$customer->district.' - '.$customer->city !!}
                </td>
                <td>{!! $customer->phone !!}</td>
                <td><i class="fa fa-pencil fa-fw"></i><a href="{!! url('admin/customer/edit') !!}/{!! $customer->id !!}">Edit</a></td>
                <td><i class="fa fa-trash-o fa-fw"></i><a href="{!! url('admin/customer/delete') !!}/{!! $customer->id !!}" onclick="return window.confirm('Are you sure want to delete this customer ?')">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.row -->

@stop