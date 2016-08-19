@extends('admin.master')
@section('head.title', ' | Add Customer')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Customer
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
			<div class="panel-heading text-center">Add Customer</div>
			<div class="panel-body">

				<form method="post" action="{!! asset('admin/customer/add') !!}">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="form-group">
						<label for="customer_name">Customer Name</label>
						<input class="form-control" name="name" placeholder="Please Enter Customer Name" value="{!! old('txtName',isset($customer)?$customer['name']:null) !!}" />
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input class="form-control" name="address" placeholder="Please Enter Customer Address" value="{!! old('txtName',isset($customer)?$customer['address']:null) !!}" />
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<select class="form-control" id="province" name="province" onchange="province_onchange(this);">
							<option value="">Tỉnh/Thành phố</option>
							@foreach($provinces as $province)
							<option value="{{$province->id}}">{{mb_convert_case($province->name, MB_CASE_TITLE, "UTF-8")}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="district">District</label>
						<select class="form-control" id="district" name="district">
							<option value="">Quận/Huyện</option>
						</select>
					</div>
					<div class="form-group">
						<label for="phone">Phone</label>
						<input class="form-control" type="text" name="phone" placeholder="Please Enter Customer Phone" value="{!! old('txtName',isset($customer)?$customer['phone']:null) !!}" />
					</div>
					<div class="form-group">
						<label for="email">E-mail</label>
						<input class="form-control" type="email" name="email" placeholder="Please Enter Customer Phone" value="{!! old('txtName',isset($customer)?$customer['phone']:null) !!}" />
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
<script>
	function province_onchange(btn){
		var id = $(btn).val();
		if(id == '') {
			$('#district').html("<option value=''>Quận/Huyện</option>");
			return false;
		}
		$.ajax({
			type: 'POST',
			url: "{{url('get/district')}}",
			data: {province_id: id},
			success: function(data){
				$('#district').html("<option value=''>Quận/Huyện</option>");
				for(var i = 0; i<data.length; i++){
					$('#district').append("<option value='"+ data[i].id +"'>"+ data[i].name +"</option>");
				}
			}
		});
	}
</script>
@stop
