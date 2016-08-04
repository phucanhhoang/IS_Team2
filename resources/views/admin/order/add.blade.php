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
		<div class="panel panel-primary">
			<div class="panel-heading text-center">Add Order</div>
			<div class="panel-body">

				<form method="post" action="{!! url('admin/order/add') !!}">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="form-group">
						<label for="customer_name">Customer Name</label>
						<input class="form-control" name="customer_name" id="custom_name" placeholder="Please Enter Customer Name" />
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" name="customer_id" id="custom_id" required="false" />
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input class="form-control" name="address" id="custom_addr" placeholder="Please Enter Customer Address" />
					</div>
					<div class="form-group">
						<label for="district">District</label>
						<input class="form-control" name="district" id="custom_ditr" placeholder="Please Enter District" />
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input class="form-control" name="city" id="custom_city" placeholder="Please Enter City" />
					</div>
					<div class="form-group">
						<label for="phone">Phone</label>
						<input class="form-control" name="phone" id="custom_phone" placeholder="Please Enter Customer Phone" />
					</div>
					<div class="form-group">
						<label for="pro_id">Product</label>
						<select name="pro_id" class="form-control" id="drdProduct" required>
							<option value="">Please Choose Product</option>
							@foreach($products as $product)
							<option value="{!! $product['id'] !!}">{!! $product['pro_name'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="size_id">Size</label>
						<select name="size_id" class="form-control" id="chk_size" required>
							<option value="">Please Choose Size</option>
							@foreach($sizes as $size)
							<option value="{!! $size['id'] !!}">{!! $size['size'] !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<p class="title">Color</p>
						<div class="mausac" id="chk_color">
							<?php $stt = 0; ?>
							@foreach($img_colors as $color)
							<?php 
								$stt++;
								$url_img = asset('upload/images/colors/'.$color->color);
							?>
							<input type="radio" name="color_id" value="{{ $color->id }}" id="{{ 'ms-check'.$stt }}"  />
                            <label for="{{ 'ms-check'.$stt }}" style="background-image: url('<?php echo $url_img; ?>')"></label>
							@endforeach
						</div>
					</div>
					<div class="form-group">
						<label for="qty">Quantity Order</label>
						<input type="number" name="qty" value="" class="form-control" style="width: 100px;">
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

@section('body.js')
<script type="text/javascript">
//lay thong tin khach hang
$('#custom_name').change(function() {
	var customer_name = $(this).val();
	$.ajax({
		url: "{{ asset('admin/order/pro_change') }}",
		type: "POST",
		data: {customer_name: customer_name},
		cache: false,
		success: function (data) {
			$('#custom_id').html("");
			for (var i = 0; i < data['customers'].length; i++) {
				$('#custom_id').val(data['customers'][i].id);
			}
			// $('#custom_id').prop('required', false);

			$('#custom_addr').html("");
			for (var i = 0; i < data['customers'].length; i++) {
				$('#custom_addr').val(data['customers'][i].address);
			}

			$('#custom_ditr').html("");
			for (var i = 0; i < data['customers'].length; i++) {
				$('#custom_ditr').val(data['customers'][i].district);
			}

			$('#custom_city').html("");
			for (var i = 0; i < data['customers'].length; i++) {
				$('#custom_city').val(data['customers'][i].city);
			}

			$('#custom_phone').html("");
			for (var i = 0; i < data['customers'].length; i++) {
				$('#custom_phone').val(data['customers'][i].phone);
			}
		}
	});
	
});

// thong tin san pham
$('#drdProduct').change(function() {
	var pro_id = $(this).val();
	$.ajax({
		url: "{{ asset('admin/order/pro_change') }}",
		type: "POST",
		data: {pro_id: pro_id},
		cache: false,
		success: function (data) {
			//size
			$('#chk_size').html("");
			$('#chk_size').append("<option value=''>Please Choose Size</option>");
			for(var i = 0; i < data['sizes'].length; i++ ){
				$('#chk_size').append("<option value='"+data['sizes'][i].id+"'>"+data['sizes'][i].size+"</option>");
			}

			//color
			$('#chk_color').html("");
			var stt=0;
			for (var i = 0; i < data['colors'].length; i++) {
				stt++;
				var url = "{{asset('upload/images/colors')}}"+ '/' + data['colors'][i].color;
				$('#chk_color').append("<input type='radio' name='color_id' value='"+data['colors'][i].id+"' id='ms-check"+stt+"' /><label for='ms-check"+stt+"' style='background-image: url("+ url +")'></label>");
			}
			
		}
	});
});
	
</script>
@stop