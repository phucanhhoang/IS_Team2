@extends('admin.master')
@section('head.title', ' | Add Order')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Order
            <small>Add</small>
        </h1>
    </div>
</div>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{!! $error !!}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="panel panel-primary">
			<div class="panel-heading text-center">Add Order</div>
			<div class="panel-body">

				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="form-group">
						<label for="customer_id">Customer ID</label>
						<select name="customer_id" class="form-control" required>
							<option value="">Please Choose Customer</option>
							@foreach($orders as $order)
							<option value="{!! $order['customer_id'] !!}">{!! $order['customer_id'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="pro_id">Product ID</label>
						<select name="pro_id" class="form-control" required>
							<option value="">Please Choose Product</option>
							@foreach($products as $product)
							<option value="{!! $product['id'] !!}">{!! $product['pro_name'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="size_id">Size</label>
						<select name="size_id" class="form-control" required>
							<option value="">Please Choose Size</option>
							@foreach($sizes as $size)
							<option value="{!! $size['id'] !!}">{!! $size['size'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="color_id">Color ID</label>
						<select name="color_id" class="form-control" required>
							<option value="">Please Choose Color</option>
							@foreach($colors as $color)
							<option value="{!! $color['color_id'] !!}">{!! $color['color_id'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="qty">Quantity Order</label>
						<input type="number" name="qty" value="" class="form-control">
					</div>
		            <div class="text-right">
						<input type="submit" class="btn btn-primary" value="Add" />
						<input type="reset" class="btn btn-default" value="Reset" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop