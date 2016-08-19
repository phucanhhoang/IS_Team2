@extends('admin.master')
@section('head.title', ' | Add Category')
@section('content')
@section('style')
<style>
	.error {
		color: red;
	}
</style>
@stop
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
      <li><a href="{!! url('admin/category') !!}">Category</a></li>
      <li class="active">Create</li>
    </ol>
</div>
<div class="row">
	<div class="col-lg-4">
		<table id="cat_table" class="table table-striped table-bordered table-hover">
	        <thead>
	            <tr>
	                <th class="text-center">STT</th>
	                <th class="text-center">Category Name</th>
	                <th class="text-center">Parent Category</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php  $stt = 1; ?>
	            @foreach($cats as $cat)
	                <tr>
	                    <td class="text-center">{!! $stt++ !!}</td>
	                    <td>
	                    	<p>{!! $cat->cat_title !!}</p>
	                    </td>
	                    <td>
	                        @if($cat->parent_id == 0)
	                            {!! "<p style='color: red'>None</p>"!!}
	                        @else 
	                            <?php
	                                $parent = DB::table('categories')->where('id', $cat->parent_id)->first();
	                                echo $parent->cat_title;
	                            ?>
	                        @endif
	                    </td>
		            </tr>
		        @endforeach
	        </tbody>
	    </table>
	</div>
	<div class="col-lg-6 col-lg-offset-1">
		
		<div class="panel panel-primary">
			<div class="panel-heading text-center">Create A New Category</div>
			<div class="panel-body">
				
				<form action="{!! route('admin.category.store') !!}" method="POST" role="form" id="newCatForm">
					<input type="hidden" name="_token" value="{!! csrf_token(); !!}">
					<div class="form-group">
						<label for="parent_id">Parent Category</label>
						<select name="parent_id" class="form-control" id="parent_id">
							<option value="">Please choose a category</option>
							@foreach($parents as $parent)
								<option value="{!! $parent->id !!}">
									{!! $parent->cat_title !!}
								</option>
							@endforeach
							<option value="0">None</option>
						</select>
						<p class="error">{!! $errors->first('parent_id') !!}</p>
					</div>
					<div class="form-group">
						<label for="cat_title">Category Name</label>
						<input type="text" class="form-control" name="cat_title" value="{!! old('cat_title') !!}" placeholder="Category Name">
					</div>
					<p class="error">{!! $errors->first('cat_title') !!}</p>
					<button type="submit" class="btn btn-primary">Create</button>

				</form>
			</div>
		</div>
	</div>
</div>
@stop
@section('body.js')
	<script>
		// $('#btn_newCatParent').click(function(event) {
		// 	var data = $('#newCatParent_form').serialize();
		// 	$.ajax({
		// 		url: "{{asset('admin/newcat')}}",
		// 		type: 'POST',
		// 		data: data,
		// 		cache: false,
		// 		success: function(msg){
		// 			$('#cat_table > tbody').append("<tr><td class='text-center'>"+ msg +"</td><td>"+$('#cat_title').val()+"</td><td><p style='color: red'>None</p></td>");
					
		// 			alert('Created New Category successfully');
		// 			$('#myModal').modal('hide');
		// 		}
		// 	});
			
		// });
	</script>
@stop