@extends('admin.master')
@section('head.title', ' | Edit Customer')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Customer
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
		<div class="panel panel-primary">
			<div class="panel-heading text-center">Edit Customer</div>
			<div class="panel-body">

				<form method="post" action="">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="form-group">
						<label for="customer_name">Customer Name</label>
						<input class="form-control" name="customer_name" placeholder="Please Enter Customer Name" value="{!! old('customer_name',isset($customer)?$customer['name']:null) !!}" />
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input class="form-control" name="address" placeholder="Please Enter Customer Address" value="{!! old('address',isset($customer)?$customer['address']:null) !!}" />
					</div>
					<div class="form-group">
						<label for="district">District</label>
						<input class="form-control" name="district" placeholder="Please Enter District" value="{!! old('district',isset($customer)?$customer['district']:null) !!}" />
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input class="form-control" name="city" placeholder="Please Enter City" value="{!! old('city',isset($customer)?$customer['city']:null) !!}" />
					</div>
					<div class="form-group">
						<label for="phone">Phone</label>
						<input class="form-control" name="phone" placeholder="Please Enter Customer Phone" value="{!! old('phone',isset($customer)?$customer['phone']:null) !!}" />
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
