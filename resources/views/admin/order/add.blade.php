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
    width: 100px;
}
.ui-menu .ui-menu-item .ui-state-focus{
    background-color: #eeeeee;
    color: #252525;
    border-color: transparent;
}
</style>

<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Order
            <small>Add</small>
        </h1>
    </div>
</div>
<form method="post" action="{!! url('admin/order/add') !!}" id="form_id">
	<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
<div class="row">
	<div class="col-sm-6">
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

					<div class="panel panel-info">
						<div class="panel-heading">Customer</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="custom_phone">Customer Phone</label>
								<input class="form-control" name="custom_phone" id="custom_phone" placeholder="Please Enter Customer Phone" />
							</div>
							<div class="form-group">
								<label for="custom_name">Customer Name</label>
								<input class="form-control" name="custom_name" id="custom_name" placeholder="Please Enter Customer Name" />
							</div>
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">Select Product</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="drdProduct">Product</label>
								<select name="product_id" class="form-control" id="drdProduct" required>
									<option value="">Please Choose Product</option>
									@foreach($products as $product)
									<option value="{!! $product->id !!}">{!! $product->pro_name !!}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="chk_size">Size</label>
								<select name="size_id" class="form-control" id="chk_size" required>
									<option value="">Please Choose Size</option>
									@foreach($sizes as $size)
									<option value="{!! $size->id !!}">{!! $size->size !!}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="chk_color">Color</label>
								<div class="mausac" id="chk_color">	
									<?php $stt = 0; ?>
									@foreach($img_colors as $color)
									<?php 
										$stt++;
									?>
									<input type="radio" name="color_id" class="chk_color" value="{{ $color->id }}" id="{{ 'ms-check'.$stt }}"  />
		                            <label for="{{ 'ms-check'.$stt }}" style="<?php echo 'background-color: '.$color->color; ?>"></label>
									@endforeach
								</div>
							</div>
							<div class="form-group">
								<label for="quantity">Quantity Order</label>
								<input type="number" name="quantity" value="" class="form-control" id="quantity" style="width: 100px;">
							</div>
						</div>
		            	<button type="button" class="btn btn-danger" id="more" style="margin-bottom: 10px; margin-left: 15px;">
		            		<i class="fa fa-plus" aria-hidden="true"></i> Add More
		            	</button>
					</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-info">
			<div class="panel-heading text-center">Customer Info</div>
			<div class="panel-body" id="custom_info"></div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel panel-info">
			<div class="panel-heading text-center">Order Info</div>
			<div class="panel-body" id="order_info">
				<?php
				$carts = \Cart::content();
				?>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">Product Name</th>
							<th class="text-center">Image</th>
							<th class="text-center">Size</th>
							<th class="text-center">Color</th>
							<th class="text-center">Quantity</th>
							<th class="text-center">Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($carts as $cart) {
						?>
						<tr align="center" class="cart_id{{$cart->rowid}}">
							<td>{{ $cart->name }}</td>
							<td><img src="{{ asset('upload/images/'.$cart->options->image) }}" width="75" height="75" /></td>
							<td>{{ $cart->options->size }}</td>
							<td><div style="<?php echo 'background-color: '.$cart->options->color; ?>;<?php echo 'color: '.$cart->options->color; ?>; width: 20px">a</div></td>
							<td><input type="number" id="{{$cart->rowid}}" class="qty_num qty_num{{ $cart->rowid }}" onkeyup="num_cart_validate(this);" onchange="qty_onchange(this);" min="1" max="20" value="{{ $cart->qty }}" /></td>
							<td><a class="btn_del" onclick="cart_del(this);" id="{{ $cart->rowid }}" p-name="{{ $cart->name }}"><i class="fa fa-times-circle"></i></a></td>
						</tr>
					<?php }; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="text-right">
	<input type="submit" class="btn btn-primary" value="Add Order" />
	<input type="button" class="btn btn-default" id="reset_btn" value="Reset" />
</div>
</form>
@stop

@section('body.js')
<script type="text/javascript">
$('#custom_phone').keyup(function(){
	$.ajax({
		type: "POST",
		url: "{{ asset('admin/order/search') }}",
		success: function(data){
			$('#custom_phone').autocomplete({
				source: data
			});
		}
	});
});

$('#custom_phone').on('autocompleteselect', function(event, ui) {
	
	value = ui.item.value.split(" - ");
	$(this).val(ui.item.value);
	// alert($(this).val());
	name = value[0];
	phone = value[1];
	email = value[2];
	address = value[3];
	district = value[4];
	province = value[5];

	$('#custom_name').val(name);
	$('#custom_phone').val(phone);

	$('#custom_info').html("");
	$('#custom_info').append("<div><b>Name:</b> "+name+"</div><div><b>Phone:</b> "+phone+"</div><div><b>Email:</b> "+email+"</div><div><b>Address:</b> "+address+"</div><div><b>District:</b> "+district+"</div><div><b>Province:</b> "+province+"</div>");

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
				$('#chk_color').append("<input type='radio' name='color_id' value='"+data['colors'][i].id+"' id='ms-check"+stt+"' /><label for='ms-check"+stt+"' style='background-color: "+ data['colors'][i].color +"'></label>");
			}
		}
	});
});


$(document).ready(function() {

	$('#more').click(function(event) {
		var data = $('#form_id').serialize();
		$.ajax({
			url: "{{ asset('cart/add') }}",
			type: 'POST',
			data: data,
			cache: false,
			success: function (data) {
				if (data == false) {
					alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
				} else{
					$('#order_info > table > tbody').html('');
					$.each(data, function(rowid, cart) {
						var url = "{{ asset('upload/images') }}" + "/" + cart.options.image;
						$('#order_info > table > tbody').append("<tr align='center' class='cart_id"+ cart.rowid +"'>" + 
							"<td>"+ cart.name +"</td>" + 
							"<td><img src='"+ url +"' width='75'; height='75'/></td>" + 
							"<td>"+ cart.options.size +"</td>" + 
							"<td><div style='width: 20px;background-color:"+ cart.options.color +";color:"+ cart.options.color +"'>a</div></td>" + 
							"<td><input type='number' class='qty_num qty_num"+cart.rowid+"' id='"+cart.rowid+"' " +
                            "onkeyup='num_cart_validate(this);' " +
                            "onchange='qty_onchange(this);' min='1' max='20' value='"+cart.qty+"' /></td>" + 
                            "<td><a class='btn_del' onclick='cart_del(this);' id='"+ cart.rowid +"'" +
                            "p-name='"+ cart.name +"'><i class='fa fa-times-circle'></i></a></td>" +
                            "</tr>");
					});
				}
			}
		});
		
	});

	$('#reset_btn').click(function() {
		$('#drdProduct').val("");
		$('#chk_size').val("");
		$('#form_id input:radio').removeAttr('checked');
		$('#quantity').val("");
	});

	if ($('#order_info > table > tbody').html() !== '') {
		$('#drdProduct').removeAttr('required');
		$('#chk_size').removeAttr('required');
	}
});

function cart_del(btn) {
        var pro_name = $(btn).attr('p-name');
        if(confirm("Bạn chắc chắn muốn xóa [ "+ pro_name +" ] khỏi giỏ hàng?")){
            var cart_id = $(btn).attr('id');
            $.ajax({
                type: 'POST',
                url: "{{asset('cart/delete')}}",
                data: {id: cart_id},
                cache: false,
                success: function(msg){
                    if (msg === 'true') {
                        $('.cart_id' + cart_id).fadeOut(function () {
                            $(this).remove();
                        });
                        var total_money = parseInt($('#total_money').val()) - parseInt($(btn).parents('tr').attr('money'));
                        $('#total_money').val(total_money);
                        total_money = accounting.formatNumber(total_money, 0, ".", ",");
                        $('.cart_total').html(total_money);
                        var cart_num = parseInt($('#cart_num').html()) - parseInt($($('.cart_id' + cart_id).find('input')[0]).val());
                        $('#cart_num').html(cart_num);
                        if(cart_num == 0){
                            $('#cart_num').hide();
                            if("{{URL::current()}}" == "{{asset('checkout')}}")
                                location.reload();
                        }
                    }
                    else{
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    }
                }
            });
        }
    }

    function qty_onchange(num){
        var cart_id = $(num).attr('id');
        $('.qty_num' + cart_id).val($(num).val());
        var qty = $(num).val();
        $.ajax({
            type: 'POST',
            url: "{{asset('cart/change')}}",
            data: {id: cart_id, quantity: qty},
            cache: false,
            success: function(data){
                console.log(data);
                if(data['msg'] == 'true'){
                    $('#cart_num').html(parseInt(data['count']));
                    var money = parseInt(data['money']);
                    var total_money = parseInt(data['subtotal']);
                    $(num).parents('tr').attr('money', money);
                    $('#total_money').val(total_money);
                    money = accounting.formatNumber(money, 0, ".", ",");
                    total_money = accounting.formatNumber(total_money, 0, ".", ",");

                    $('#order_table > tbody > tr.cart_id'+ cart_id +' > td:last-child').html(money + ' đ');
                    $('.cart_total').html(total_money);
                }
                else{
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            }
        });
    }
    function num_cart_validate(btn){
        $(btn).val($(btn).val().replace(/[^1-9]/g,''));
    }
</script>
@stop