@extends('admin.master')
@section('head.title', ' | Add Product')
@section('content')
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
      <li><a href="{!! url('admin/product') !!}">Product</a></li>
      <li class="active">Create</li>
    </ol>
</div>
<div class="row">
    <h1 class="lead" style="font-size: 2.5em; color:rgb(255,0,0)">Product
        <small>Add</small>
    </h1>
</div>
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{!! $error !!}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<form method="post" action="{!! route('admin.product.store') !!}" enctype = "multipart/form-data">
			<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
			<div class="row">
				<div class="col-sm-5">
					<div class="form-group">
							<label for="pro_name">Product Name</label>
							<input type="text" name="pro_name" value="{!! old('pro_name') !!}" class="form-control" placeholder="name">
					</div>
					<div class="form-group">
						<label for="pro_code">Product code</label>
						<input type="text" name="pro_code" value="{!! old('pro_code') !!}" placeholder="code" class="form-control">
					</div>
					<div class="form-group">
						<label for="pro_cat">Product Category</label>
						<select name="cat_id" class="form-control">
							<option value="">Please choose a category</option>
							@foreach($pro_cat as $p_cat)
								@if($p_cat->parent_id == 0) 
									<option value="{!! $p_cat->id !!}" disabled="disabled">
										{!! $p_cat->cat_title !!}
									</option>
								@else {
									<option value="{!! $p_cat->id !!}">
										{!! $p_cat->cat_title !!}
									</option>
								}
								@endif
							@endforeach
						</select>

					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="text" name="price" value="{!! old('price') !!}" class="form-control" placeholder="price">
					</div>
					<div class="form-group">
						<label for="discount">Discount(%)</label>
						<input type="text" name="discount" value="{!! old('discount') !!}" class="form-control" placeholder="discount">
					</div>
					
					<div class="form-group">
						<label for="image">Product Image</label>
						<input type="file" name="image">
					</div>
					
				</div>
				<div class="col-sm-7">
					<div class="form-group">
						<input type='hidden' id='str_sizes' name="str_sizes" />
						<label for="size">Size</label>
						<br>
						@foreach($sizes as $size)
							<input type="checkbox" class='chk_size' value="{!! $size->id !!}">{!! $size->size !!}
						@endforeach
					</div>
					
					<div class="form-group">
						<label for="img_color">Detail Images</label>
						<div class="table-responsive">  
	                        <table class="table table-bordered" id="dynamic_field">  
	                            <tr>  
	                                <td>
	                                	<input type="file" name="file[]" class="form-control name_list" />
	                                	
	                                </td>

	                                <td>
	                                	<button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus-square"></i> Add More</button>
	                                </td>
	                                <td>
					                    <div class="form-group">
											<div class="form-group mausac">
												<input type='hidden' id='str_colors' name="str_colors" />
						                        <?php
						                            $stt = 0;
						                            foreach($colors as $color){
						                                $stt++;
						                                $url_img = asset('upload/images/colors/'.$color->color);
						                        ?>
						                                <input type="checkbox" class='chk_color' value="{{$color->id}}" id="{{'ms-check'.$stt}}"/>
						                                <label for="{{'ms-check'.$stt}}" style="background-image: url('<?php echo $url_img ?>')"></label>

						                        <?php } ?>
						                    </div>
					                    </div>
	                                </td>    
	                            </tr>  
	                        </table>  
	                    </div>
                    </div>  
				</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="full_des">Full description</label>
							<textarea name="full_des" class="form-control" val =
							"{!! old('full_des') !!}"></textarea>
							<script>CKEDITOR.replace( 'full_des' );</script>
						</div>
					</div>
				</div>
				<div class="row col-sm-12">
					<input type="submit" class="btn btn-info" value="Add Product" />
					<input type="reset" class="btn btn-danger" value="Clear" />
				</div>
			</div>
		</form>
	</div>
</div>
@stop
@section('body.js')
	<script type="text/javascript" src="{!! asset('admin/javascript/myscript.js') !!}"></script>
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