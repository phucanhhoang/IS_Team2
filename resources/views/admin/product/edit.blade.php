@extends('admin.master')
@section('head.title', ' | Product List')
@section('content')
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
      <li><a href="{!! url('admin/product') !!}">Product</a></li>
      <li class="active">Edit</li>
    </ol>
</div>
	
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
    	@if(count($errors) > 0)
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<ul>
					@foreach($errors->all() as $error)
						<li>{!! $error !!}</li>
					@endforeach
				</ul>
			</div>
		@endif
        <div class="panel panel-primary">
            <div class="panel-heading text-center" style="font-size: 20px">Edit product</div>
            <div class="panel-body">
                {!! Form::model($product,['route' => ['admin.product.update',$product->id], 'method' => 'PUT', 'files' => true]) !!}
					<div class="form-group">
						{!! Form::label('pro_name', 'Product Name' ,['class' => 'control-label']) !!}
						{!! Form::text('pro_name', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('pro_code', 'Product Code' ,['class' => 'control-label']) !!}
						{!! Form::text('pro_code', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cat_id', 'Product Category' ,['class' => 'control-label']) !!}
						{!! Form::select('cat_id', [
								'2' => 'Áo phông',
								'3' => 'Áo sơ mi',
								'5' => 'Chân váy',
								'8' => 'Quần short',
								'9' => 'Quần jeans',
								'6' => 'Váy dài'
							], $product->cat_id)
						!!}
					</div>
					<!-- <div class="form-group">
						<label for="pro_cat">Product Category</label>
						<select name="cat_id" class="form-control">
							<option value="">Please choose a category</option>
							@foreach($pro_cat as $p_cat)
								<option value="{!! isset($product->cat_id) ? $product->cat_title : "" !!}"></option>
							@endforeach
						</select>
					</div> -->
					<div class="form-group">
						{!! Form::label('price', 'Price' ,['class' => 'control-label']) !!}
						{!! Form::text('price', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('discount', 'Discount' ,['class' => 'control-label']) !!}
						{!! Form::text('discount', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						<input type='hidden' id='str_sizes' name="str_sizes" />
						{!! Form::label('size', 'Size' ,['class' => 'control-label']) !!}
						@foreach($sizes as $size)
							<input type="checkbox" class='chk_size' value="{!! $size->id !!}"  checked="checked">{!! $size->size !!}
							<input type="text" value="{!! $size->size !!}">
						@endforeach
						
					</div>
					<div class="form-group">
						{!! Form::label('full_des', 'Description' ,['class' => 'control-label']) !!}
						{!! Form::textarea('full_des', null, ['class' => 'form-control']) !!}
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
					
					<div class="row">
						<div class="col-sm-6">
							{!! Form::submit('Save Changes', ['class' => 'btn btn-info btn-block']) !!}
						</div>
						<div class="col-sm-6">
							<a href="{!! route('admin.product.show',$product->id) !!}" class="btn btn-danger btn-block">Cancel</a>
						</div>
					</div>
				{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
@section('body.js')
<script type="text/javascript">
	var str_sizes = '';
		$('.chk_size').click(function(event) {
				str_sizes += $(this).val() + ';';
			$('#str_sizes').val(str_sizes);
		});


	var str_colors = '';
		$('.chk_color').click(function(event) {
			str_colors += $(this).val() + ';';
			$('#str_colors').val(str_colors);
		});
		
</script>
@stop