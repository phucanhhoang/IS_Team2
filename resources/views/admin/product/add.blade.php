@extends('admin.master')
@section('head.title', ' | Add Product')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Product
            <small>Add</small>
        </h1>
    </div>
    <div class="col-sm-6">
        <form class="navbar-form navbar-right" role="search">
          <input type="text" class="form-control" placeholder="Search..">
      </form>
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
			<div class="panel-heading text-center">Add more products</div>
			<div class="panel-body">

				<form method="post" action="{{asset('admin/product/postAddPro')}}">
					<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
					<div class="form-group">
						<label for="pro_name">Product Name</label>
						<input type="text" name="pro_name" value="{!! old('pro_name') !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="pro_code">Product code</label>
						<input type="text" name="pro_code" value="{!! old('pro_code') !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="cat_id">Product Category</label>
						<select name="cat_id" class="form-control" required="required">
							<option value="">Please choose a category</option>
							<option value="2">Áo Phông</option>
							<option value="3">Áo sơ mi</option>
							<option value="5">Chân váy</option>
							<option value="8">Quần short</option>
							<option value="9">Quần jeans</option>
							<option value="6">Váy dài</option>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="text" name="price" value="{!! old('price') !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="discount">Discount(%)</label>
						<input type="text" name="discount" value="{!! old('discount') !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="short_des">Short description</label>
						<textarea name="short_des" class="form-control" val = "{!! old('short_des') !!}"></textarea>
					</div>
					<div class="form-group">
						<label for="full_des">Full description</label>
						<textarea name="full_des" class="form-control" val =
						"{!! old('full_des') !!}"></textarea>
						<script>CKEDITOR.replace( 'full_des' );</script>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="image">Product Image</label>
								<input type="file" name="image">
							</div>
						</div>
						<div class="col-sm-6">
							<label for="mul_image">Upload images</label>
							<input type="file" name="mul_image">
						</div>
					</div>
					<div class="text-right">
							<input type="submit" class="btn btn-info" value="Add Product" />
							<input type="reset" class="btn btn-danger" value="Clear" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop