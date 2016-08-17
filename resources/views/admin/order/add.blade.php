@extends('admin.master')
@section('head.title', ' | Add Order')
@section('content')
<style>
	/*Search style*/
.ui-widget-content{
    max-height: 250px;
    overflow-y: auto;
    overflow-x: hidden;
    background-color: #ffffff;
}
.ui-menu .ui-menu-item .ui-state-focus{
    background-color: #eeeeee;
    color: #252525;
    border-color: transparent;
}
input:focus{border:1px solid yellow;}
</style>

<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Order
            <small>Add</small>
        </h1>
    </div>
</div>
<div class="row">
	<div class="col-sm-4">
		<div class="panel panel-info">
			<div class="panel-heading text-center">Order Info</div>
			<div class="panel-body" id="order_info">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Size</th>
							<th>Color</th>
							<th>Quantity</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-sm-5">
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
				<form method="post" action="{!! url('admin/order/add') !!}" id="form_id">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="panel panel-info">
						<div class="panel-heading">Customer</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="information">Customer Name Or Phone Number</label>
								<input class="form-control" name="information" id="custom_name" placeholder="Please Enter Customer Name Or Phone Number" />
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">Select Product</div>
						<div class="panel-body">
							<div class="form-group">
								<input type="hidden" name="str_product" id="str_product">
								<label for="pro_id">Product</label>
								<select name="pro_id" class="form-control" id="drdProduct" required>
									<option value="">Please Choose Product</option>
									@foreach($products as $product)
									<option value="{!! $product->id !!}">{!! $product->pro_name !!}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<input type="hidden" name="str_size" id="str_size">
								<label for="size_id">Size</label>
								<select name="size_id" class="form-control" id="chk_size" required>
									<option value="">Please Choose Size</option>
									@foreach($sizes as $size)
									<option value="{!! $size->id !!}">{!! $size->size !!}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="color_id">Color</label>
								<input type="hidden" name="str_color" id="str_color">
								<div class="mausac" id="chk_color">	
									<?php $stt = 0; ?>
									@foreach($img_colors as $color)
									<?php 
										$stt++;
										$url_img = asset('upload/images/'.$color->color); 
									?>
									<input type="radio" name="color_id" class="chk_color" value="{{ $color->id }}" id="{{ 'ms-check'.$stt }}"  />
		                            <label for="{{ 'ms-check'.$stt }}" style="background-image: url('<?php echo $url_img; ?>')"></label>
									@endforeach
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="str_qty" id="str_qty">
								<label for="qty">Quantity Order</label>
								<input type="number" name="qty" value="" class="form-control" id="quantity" style="width: 100px;">
							</div>
						</div>
		            	<button type="button" class="btn btn-danger" id="more" style="margin-bottom: 10px; margin-left: 15px;">
		            		<i class="fa fa-plus" aria-hidden="true"></i> Add More
		            	</button>
					</div>
					<div class="divide"></div>
					<div class="text-right">
						<input type="submit" class="btn btn-primary" value="Add Order" />
						<input type="reset" class="btn btn-default" id="reset_btn" value="Reset" />
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-info">
			<div class="panel-heading text-center">Customer Info</div>
			<div class="panel-body" id="custom_info"></div>
		</div>
	</div>
</div>
@stop

@section('body.js')
<script type="text/javascript">
$('#custom_name').keyup(function(){
	$.ajax({
		type: "POST",
		url: "{{ asset('admin/order/search') }}",
		success: function(data){
			$('#custom_name').autocomplete({
				source: data,
				select: function (event, ui) {
					value = ui.item.value;
					$(this).val(value);
				}
			});
		}
	});
});

$('#custom_name').on('autocompleteselect', function(event, ui) {
	$(this).val(ui.item.value);
	value = ui.item.value.split(" - ");
	name_ = value[0];
	phone_ = value[1];
	$('#custom_info').html("");
	$('#custom_info').append("<div><b>Phone:</b> "+name_+"</div><div><b>Phone:</b> "+phone_+"</div>");
	event.preventDefault();
	/* Act on the event */
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
			str_color = '';
			var stt=0;
			for (var i = 0; i < data['colors'].length; i++) {
				stt++;
				var url = "{{asset('upload/images')}}"+ '/' + data['colors'][i].color;
				$('#chk_color').append("<input type='radio' name='color_id' value='"+data['colors'][i].id+"' id='ms-check"+stt+"' /><label for='ms-check"+stt+"' style='background-image: url("+ url +")'></label>");
				$('#ms-check'+stt).click(function(event) {
					str_color += $('#ms-check'+stt).val();
				});
			}
		}
	});
});

$(document).ready(function() {
	$('#reset_btn').click(function() {
		$('#custom_info').html("");
	});	
});

</script>
@stop