@extends('admin.master')
@section('head.title', ' | Product List')
@section('content')
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
      <li><a href="{!! url('admin/product') !!}">Product</a></li>
      <li class="active">List</li>
    </ol>
</div>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        @if(Session::has('delete'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success:</strong> {!! Session::get('delete') !!}
            </div>
        @endif
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        @if(Session::has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success:</strong> {!! Session::get('message') !!}
            </div>
        @endif
    </div>
</div>
<div class="row">
    <a href="{!! route('admin.product.create') !!}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Create New Product</a>
</div>
<div class="row">
    <div class="col-sm-12">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Product
            <small>List</small>
        </h1>
    </div>
</div>
<div class="row col-sm-8 col-sm-offset-2">
	<table class="table table-striped table-bordered" id="dataTable">
        <thead>
        <tr align="center">
            <th>STT</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php $stt = 0; ?>
         @foreach($products as $pro)
        <?php $stt++ ;?>
        <tr class="odd gradeX" align="center">
            <td>{!! $stt !!}</td>
            <td ><img src="{!! url('upload/images',$pro->image) !!}" alt="" width="50"; height="50"></td>
            <td class="text-left">{!! $pro->pro_name !!}</td>
            <td class="text-left">{!! $pro->pro_code !!}</td>
           	<td>
           		<a href="{!! route('admin.product.show',$pro->id) !!}" class="btn btn-primary">
                    <i class="fa fa-eye"></i> View
                </a>
           	</td>
			<td>
				<a href="{!! route('admin.product.edit', $pro->id) !!}" class="btn btn-warning">
                    <i class="fa fa-pencil fa-fw"></i> Edit
                </a>
			</td>
			<td>
				{!! Form::open(['route' => ['admin.product.destroy', $pro->id], 'method' => 'DELETE']) !!}
                    <button type="submit" onclick="return deletePro()" class="btn btn-danger">
                        <i class="fa fa-times" aria-hidden="true" style="font-size: 15px"></i> Delete
                    </button>
                {!! Form::close() !!}
			</td>    
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
@section('body.js')

@stop