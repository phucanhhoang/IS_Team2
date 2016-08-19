@extends('admin.master')
@section('head.title', ' | Add Product')
@section('style')
<style>
	.error_msg {
		color: #ff6666;
		font-weight: 500;
	}
	.remove_button{
		position: relative;
		float: right;
		background: red;
		color: white;
	}
	.form-group.mausac {
		margin-bottom: 0;
	}
	.color_list ul li{
		padding: 5px;
		float: left;
	}
	.color_list ul{
		border: 1px solid #CCCCCC;

	}
	.color_list ul li:hover {
		background: #CCCCCC;
	}
	.table > tbody > tr > td{
		vertical-align: middle;
	}	
</style>
@stop
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
<form method="post" action="{!! route('admin.product.store') !!}" enctype = "multipart/form-data" id="insert_pro">
	<input type="hidden" value="{!! csrf_token() !!}" name="_token" />
	<div class="row">
		<div class="col-sm-5">
			<div class="form-group">
					<label for="pro_name">Product Name</label>
					<input type="text" name="pro_name" value="{!! old('pro_name') !!}" class="form-control" placeholder="name">
					<p class="error_msg">{!! $errors->first('pro_name') !!}</p>
			</div>
			<div class="form-group">
				<label for="pro_code">Product code</label>
				<input type="text" name="pro_code" value="{!! old('pro_code') !!}" placeholder="code" class="form-control">
				<p class="error_msg">{!! $errors->first('pro_code') !!}</p>
			</div>
			<div class="form-group">
				<label for="pro_cat">Product Category</label>
				<select name="cat_id" class="form-control">
					<option value="">Please choose a category</option>
					@foreach($pro_cat as $p_cat)
						@if($p_cat->parent_id != 0) 
							<option value="{!! $p_cat->id !!}">
								{!! $p_cat->cat_title !!}
							</option>
						@endif
					@endforeach
				</select>
				<p class="error_msg">{!! $errors->first('cat_id') !!}</p>
			</div>
			<div class="form-group">
				<label for="price">Price</label>
				<input type="number" name="price" value="{!! old('price') !!}" class="form-control" placeholder="price">
				<p class="error_msg">{!! $errors->first('price') !!}</p>
			</div>
			<div class="form-group">
				<label for="discount">Discount(%)</label>
				<input type="number" name="discount" value="{!! old('discount') !!}" class="form-control" placeholder="discount" min="0">
				<p class="error_msg">{!! $errors->first('discount') !!}</p>
			</div>
			<div class="form-group">
				<input type='hidden' id='str_sizes' name="str_sizes" value="" />
				<label for="size">Sizes</label>
				<br>
				@foreach($sizes as $size)
					<input type="checkbox" class='chk_size' value="{!! $size->id !!}" name="sizes[]">{!! $size->size !!}
				@endforeach
				<p class="error_msg">{!! $errors->first('sizes') !!}</p>
			</div>
		    <div class="form-group">
		    	<label for="color">Color</label>
		    	<br>
		    	<input type='hidden' id='str_colors' name="str_colors" value="" />
		    	<div class="mausac">
                    <?php
                    $img_colors = App\Color::all();
                    $stt = 0;
                    foreach($img_colors as $color){
                        $stt++;
                        ?>
                        <input type="checkbox" class="chk_color" value="{{$color->id}}" id="{{'ms-check'.$stt}}" name="colors[]" />
                        <label for="{{'ms-check'.$stt}}" style="background-color: <?php echo $color->color ?>"></label>

                    <?php } ?>
                </div>
		    </div>
		</div>	
		<div class="col-sm-7">
			<div class="form-group">
				<label for="image">Image</label>
	            <div class="imgupload panel panel-default">
	                <div class="panel-heading clearfix">
	                    <h3 class="panel-title pull-left">Upload image</h3>
	                </div>
	                <div class="file-tab panel-body">
	                    <div>
	                        <button type="button" class="btn btn-primary btn-file">
	                            <span>Browse</span>
	                            <input type="file" name="image">
	                        </button>
	                        <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Remove</button>
	                    </div>
	                </div>
	            </div>
	            <p class="error_msg">{!! $errors->first('image') !!}</p>
	        </div>
	        <div class="form-group">
	        	<button type="button" class="btn btn-info add_img"><i class="fa fa-plus-square"></i></button>
	        	<table class="table table-bordered" style="margin-top: 10px">
	        		<tbody>
	        			<tr class="text-center">
	        				<td>
	        					<input type="file" name="images[]">
	        				</td>

	        				<td><i class = "fa fa-times btn btn-square remove_button"></i></td>
	        			</tr>
	        		</tbody>
	        	</table>
	        </div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label for="full_des">Full description</label>
					<textarea name="full_des" class="form-control" val = "{!! old('full_des') !!}"></textarea>
					<script>CKEDITOR.replace( 'full_des' );</script>
					<p class="error_msg">{!! $errors->first('full_des') !!}</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<input type="submit" id="add_pro" class="btn btn-info" value="Add Product" />
				<input type="reset" class="btn btn-danger" value="Clear" />
			</div>

		</div>
	</div>
</form>
</div>
</div>
@stop
@section('body.js')
<script src="{!! asset('admin/js/imgupload.min.js') !!}"></script>
<script type="text/javascript">
	//show color when choosing color
	$(".chk_color").change(function(event) {
		state = $(this).prop('checked');
		if(state == true){
			$(this).val();
			color = $(this).attr('color');
			$(this).parents('tr').find('label.show_color').css('background', color).css({
					'width': '20px',
					'height': '20px',
					'border': '1px solid #aaaaaa'
			});
		} else {
			$(this).parents('tr').find('label.show_color').remove();
		}
		
	});
	//add more detail images
    <?php $x = 0;  ?>
    $('.add_img').click(function(){
    	<?php $x++; ?>

        $("table tbody").append('<tr class="text-center"><td><input type="file" name="images[]" /></td><td><i class = "fa fa-times btn btn-square remove_button"></i></td></tr>');
    });
    
    $('table tbody').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parentsUntil('tbody').remove(); 
        
    });
	//checkbox sizes
	$(document).ready(function() {
        $(".chk_size").click(function(){
            var str_sizes = [];
            $.each($("input[name='sizes[]']:checked"), function(){            
                str_sizes.push($(this).val());
               
            });
             str_sizes = str_sizes.join(";");
            $('#str_sizes').val(str_sizes);
            
        });
    });

	//checkbox colors
   $(document).ready(function() {
        $(".chk_color").click(function(){
            var str_colors = [];
            $.each($("input[name='colors[]']:checked"), function(){            
                str_colors.push($(this).val());
               
            });
             str_colors = str_colors.join(";");
            $('#str_colors').val(str_colors);
            
        });
    });
    //Upload image
    $('.imgupload').imgupload();
</script>
</script>
@stop