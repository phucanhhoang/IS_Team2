@extends('admin.master')
@section('head.title', ' | Product List')
@section('content')
@section('style')
<style>
	#list_img {
		list-style: none;
		margin: 0;
		padding: 0;
	}
	#list_img li{
		padding: 15px 0;
	}
	.del_img {
		position: relative;
		top: -40px;
		left: -20px;
		background: red;
	}
	.remove_button{
		position: relative;
		top: -25px;
		float: right;
		background: red;
		color: white;
	}
</style>
@stop
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
                {!! Form::model($product,['route' => ['admin.product.update',$product->id], 'method' => 'PUT', 'files' => true, 'id' => 'edit_pro'])  !!}
                	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<div class="form-group">
							<label for="pro_name">Product Name</label>
							<input type="text" name="pro_name" value="{!! $product->pro_name !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="pro_code">Product code</label>
						<input type="text" name="pro_code" value="{!! $product->pro_code !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="pro_cat">Product Category</label>
						
						<select name="cat_id" class="form-control">
							@foreach($cats as $cat)
								@if($cat->parent_id != 0)
									<option value="{!! $cat->id !!}" {!! $cat->id == $product->cat_id ? 'selected' : '' !!}>{!! $cat->cat_title !!}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="price">Price(VNĐ)</label>
						<input type="number" name="price" value="{!! $product->price !!}" class="form-control">
					</div>
					<div class="form-group">
						<label for="discount">Discount(%)</label>
						<input type="number" min="0" name="discount" value="{!! $product->discount !!}" class="form-control">
					</div>
					<!-- <div class="form-group">
						<input type='hidden' id='str_sizes' name="str_sizes" value="" />
						<label for="size">Size</label>
						<br>
						@foreach($sizes as $size)
							<input type="checkbox" class='chk_size' name="sizes[]" value="{!! $size->id !!}" disabled="disabled" checked="checked">{!! $size->size !!}
						@endforeach
						
					</div>
					<div class="form-group">
						<div class="form-group">
						<div class="form-group mausac">
							<label for="colors">Colors</label>
							<br>
							<input type='hidden' id='str_colors' name="str_colors" />
							    <?php
						        $stt = 0;
						        foreach($colors as $color){
						            $stt++;
						            $url_img = asset('upload/images/colors/'.$color->color);
						        ?>
							    <input type="checkbox" class='chk_color' value="{{$color->id}}" id="{{'ms-check'.$stt}}" name="colors[]" disabled="disabled"/>
						        <label for="{{'ms-check'.$stt}}" style="background-image: url('<?php echo $url_img ?>')"></label>
						        <?php } ?>
			            </div>
			        </div>
					</div> -->
					<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<label for="image_current">Image Current</label>
							<br>
							<img src="{!! asset('upload/images/'.$product->image) !!}" style="width: 120px; height: 120px" class="img-thumbnail" name="image">
							<input type="hidden" name="img_current" value="{!! $product->image !!}">
							<br>
							<br>
						<div class="form-group">
				            <div class="imgupload panel panel-default">
				                <div class="panel-heading clearfix">
				                    <h3 class="panel-title pull-left">Update image</h3>
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
						</div>

						<div class="col-sm-6">
							<label for="detail_img">Detail Images</label>
							<br>
							<ul id="list_img">
							@foreach($images as $key => $image)
								<li><img src="{!! asset('upload/images/details/'.$image->images) !!}" style="width: 80px; height: 80px" class="img-thumbnail" id= "{!! $key !!}" image_id = "{!! $image->id !!}">
								<i class="fa fa-times btn btn-danger btn-circle del_img "></i>
								</li>
							@endforeach
							</ul>
							<br>
							<button type="button" class="btn btn-info add_button"><i class="fa fa-plus-square"></i></button>
							<div class="add_img"></div>
						</div>
					</div>
					</div>
					
					<div class="form-group">
						<label for="full_des">Description</label>
						<textarea name="full_des" class="control-label">{!! $product->full_des !!}</textarea>
						<script>CKEDITOR.replace( 'full_des' );</script>
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
<script src="{!! asset('admin/js/imgupload.min.js') !!}"></script>
<script type="text/javascript">
	$(".chk_size").click(function(){
        var str_sizes = [];
        $.each($("input[name='sizes[]']:checked"), function(){            
            str_sizes.push($(this).val());
           
        });
         str_sizes = str_sizes.join(";");
        $('#str_sizes').val(str_sizes);
        
    });
	//Upload image
	
	//add more detail images
	var max_detail_imgs = 5;
    var x = 1; 
    $('.add_button').click(function(){
        if(x < max_detail_imgs){ 
            x++; 
            $('.add_img').append('<div style = "padding:10px 0"><input type="file" name="add_images[]" class = "img" value=""/><i class = "fa fa-times btn btn-square remove_button"></a></div>');
           
        } else {
        	alert('Sorry guy. You are allowed to upload 4 detail images at most');
        }
    });
    $('.add_img').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); 
        x--;
    });
	//remove detail images
	$(document).ready(function() {
		$(".del_img").click(function() {
			var url = "{!! asset('admin/product/deleteimage') !!}";
			//get image's id
			var img_id = $(this).parent().find("img").attr("image_id");
			//get the detail images sources in database
			var img_url = $(this).parent().find("img").attr("src");
			//remove detail images showing on screen
			var remove_img = $(this).parent().find("img").attr("id");
			$.ajax({
				url: url,
				type: 'POST',
				cache: false,
				data: {img_id: img_id, img_url: img_url},
				success: function(msg){
					if(msg == 'OK'){
						if(confirm("Hey guy. Do you really want to delete image permanently ?") == true) {
							$("#" + remove_img).parent().remove();
						} else {
							return false;
						}
					} else {
						alert("Errors.There were some problems");
					}
					
				}
			});
			
		});

	});

	$('.imgupload').imgupload();
</script>
@stop