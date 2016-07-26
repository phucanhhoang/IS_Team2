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
			<div class="panel-heading text-center">Edit Order</div>
			<div class="panel-body">

				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="form-group">
						<label for="pro_name">Product Name</label>
						<input type="text" name="pro_name" value="{!! old('pro_name',isset($detail)?$detail['pro_name']:null) !!}" class="form-control" disabled>
					</div>
					<div class="form-group">
		                <label for="img_current">Current Image</label>
		                <img src="{!! asset('upload/images/'.$product['image']) !!}" height="100" width="100" />
		                <input type="hidden" name="img_current" value="{!! $product['image'] !!}" class="custom-file-input"/>
	            	</div>
					<div class="form-group">
						<label for="size_id">Size</label>
						<select name="size_id" class="form-control" required>
							<option value="">Please Choose Size</option>
							@foreach($sizes as $size)
							<option value="{!! $size['id'] !!}" {!! $size['id'] == old('size_id') ? 'selected' : '' !!}>{!! $size['size'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="color_id">Color ID</label>
						<select name="color_id" class="form-control" required>
							<option value="">Please Choose Color</option>
							@foreach($colors as $color)
							<option value="{!! $color['color_id'] !!}" {!! $color['color_id'] == old('color_id') ? 'selected' : '' !!}>{!! $color['color_id'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="price">Price Each</label>
						<input type="text" name="price" value="{!! old('price',isset($detail)?number_format($detail['price'],'0',',','.'):null) !!}" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label for="qty">Quantity Order</label>
						<input type="number" name="qty" value="{!! old('qty',isset($detail)?$detail['qty']:null) !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="discount">Discount(%)</label>
						<input type="text" name="discount" value="{!! old('discount',isset($product)?$product['discount']:null) !!}" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label for="status">Payment</label>
						<input type="checkbox" name="status" id="status" {!! isset($data['status']) && $data['status']==1?"checked":"" !!}>
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