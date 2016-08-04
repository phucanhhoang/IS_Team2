@extends('admin.master')
@section('head.title', ' | Add Category')
@section('content')
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
	                    	<p>{!! $cat->cat_title !!}
							<!-- <i class="fa fa-pencil"  data-toggle="tooltip" title="Edit" data-placement="right" style="font-size: 18px; color: blue"></i> --></p>
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
		@if(count($errors) > 0)
			<div class="alert alert-danger" role='alert'>
				<strong>Error:</strong>
				<ul>
					@foreach($errors -> all() as $error)
						<li>{!! $error !!}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="panel panel-primary">
			<div class="panel-heading text-center">Create A New Category</div>
			<div class="panel-body">
				
				<form action="{!! route('admin.category.store') !!}" method="POST" role="form">
					<input type="hidden" name="_token" value="{!! csrf_token(); !!}">
					<div class="form-group">
						<label for="parent_id">Parent Category</label>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="float: right;"><i class="fa fa-plus-square" aria-hidden="true"></i> New</button>
			
						<select name="parent_id" class="form-control" id="parent_cat">
							<option value="">Please choose a category</option>
							@foreach($parents as $parent)
								<option value="{!! $parent->id !!}">
									{!! $parent->cat_title !!}
								</option>
							@endforeach

						</select>

					</div>
					<div class="form-group">
						<label for="cat_title">Category Name</label>
						<input type="text" class="form-control" name="cat_title" value="{!! old('cat_title') !!}">
					</div>
					<button type="submit" class="btn btn-primary">Create</button>

				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    {!! Form::open(['route' => 'admin.category.newCatParent', 'method' => 'POST' , 'id' => 'newCatParent_form']) !!}
        <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title text-center" style="color: blue">Create A New Category</h4>
        </div>
        <div class="modal-body">
        	<label for="parent_cat">Parent Category</label>
	        <select name="parent_id" class="form-control" disabled="disabled">
	        	<option value="0">None</option>
	        </select>
	        <label for="cat_title">Category Name</label>
	        <input type="text" placeholder="Category Name" name="cat_title" id='cat_title' class="form-control" value="{!! old('cat_title') !!}">
        </div>
        <div class="modal-footer">
	      	<button type="button" class="btn btn-primary" id="btn_newCatParent">Create</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    {!! Form::close() !!}
    </div>

  </div>
</div>
@stop
@section('body.js')
	<script type="text/javascript" src="{!! asset('admin/javascript/myscript.js') !!}"></script>
	<script type="text/javascript">
		$('#btn_newCatParent').click(function(event) {
			var data = $('#newCatParent_form').serialize();
			$.ajax({
				url: "{{asset('admin/newcat')}}",
				type: 'POST',
				data: data,
				cache: false,
				success: function(msg){
					
					if(msg != 'false'){
						$('#cat_table > tbody').append("<tr><td class='text-center'>"+ msg +"</td><td>"+$('#cat_title').val()+"</td><td><p style='color: red'>None</p></td>");
						alert('Created New Category successfully');
						$('#myModal').modal('hide');
					}
					
					else
						alert('There were some problems!');
				}
			})
			
		});
	</script>
@stop