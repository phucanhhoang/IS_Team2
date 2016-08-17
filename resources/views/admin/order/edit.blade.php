@extends('admin.master')
@section('head.title', ' | Edit Order')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Order
            <small>Edit</small>
        </h1>
    </div>
</div>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{!! $error !!}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<!-- customer info -->
		<div class="panel panel-info">
			<div class="panel-heading text-center">Customer Info</div>
			<div class="panel-body" id="custom_info">
				<div class="row">
					<div class="col-sm-2">Name</div>
					<div class="col-sm-4">: {!! $customer->name !!}</div>
				</div>
				<div class="row">
					<div class="col-sm-2">Phone</div>
					<div class="col-sm-4">: {!! $customer->phone !!}</div>
				</div>
				<div class="row">
					<div class="col-sm-2">Address</div>
					<div class="col-sm-4">: {!! $customer->address !!}</div>
				</div>
				<div class="row">
					<div class="col-sm-2">District</div>
					<div class="col-sm-4">: {!! $customer->district !!}</div>
				</div>
				<div class="row">
					<div class="col-sm-2">City</div>
					<div class="col-sm-4">: {!! $customer->city !!}</div>
				</div>
			</div>
		</div>
		<!-- order detail -->
		<div class="panel panel-primary">
			<div class="panel-heading text-center">Edit Order</div>
			<div class="panel-body">
				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="form-group">
						<label for="pro_id">Product</label>
						<input type="text" name="pro_id" value="{!! old('pro_id',isset($details)?$details['pro_name']:null) !!}" class="form-control" disabled />
					</div>
					<div class="form-group">
		                <label for="img_current">Image</label>
		                <img src="{!! asset('upload/images/'.$details['image']) !!}" height="100" width="100" />
		                <input type="hidden" name="img_current" value="{!! $details['image'] !!}" class="custom-file-input"/>
	            	</div>
					<div class="form-group">
						<label for="size_id">Size</label>
						<select name="size_id" class="form-control" required>
							@foreach($sizes as $size)
							<option value="{!! $size['id'] !!}" {!! $size['id'] == $details->size_id ? 'selected' : '' !!}>{!! $size['size'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="color_id">Color</label>
						<div class="mausac">
							<?php $stt = 0; ?>
							@foreach($img_colors as $color)
							<?php 
								$stt++;
								$url_img = asset('upload/images/'.$color['color']); 
							?>
							<input type="radio" name="color_id" value="{{ $color['id'] }}" {!! $color['id'] == $details->color_id ? "checked" : "" !!} id="{{ 'ms-check'.$stt }}" />
                            <label for="{{ 'ms-check'.$stt }}" style="background-image: url('<?php echo $url_img; ?>')"></label>
							@endforeach
						</div>
					</div>
					<div class="form-group">
						<label for="price">Price Each</label>
						<input type="text" name="price" value="{!! old('price',isset($details)?number_format($details['price'],'0',',','.'):null) !!}" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label for="qty">Quantity Order</label>
						<input type="number" name="qty" value="{!! old('qty',isset($details)?$details['qty']:null) !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="discount">Discount(%)</label>
						<input type="text" name="discount" value="{!! old('discount',isset($details)?$details['discount']:null) !!}" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						{!! Form::select('status', array(
			                '0' => 'Pending',
			                '1' => 'Proccessing',
			                '2' => 'Complete',
			                '3' => 'Canceled' 
			                ), $state['status'], ['class' => 'form-control']) 
			            !!}
					</div>
					
					<div class="text-right">
							<input type="submit" class="btn btn-primary" value="Edit" />
							<input type="reset" class="btn btn-default" value="Reset" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop