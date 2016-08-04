@extends('admin.master')
@section('head.title', ' | Size_Color')
@section('content')
	<div class="row">
	    <ol class="breadcrumb">
	      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
	      <li class="active">Size_Color</li>
	    </ol>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
		@if(Session::has('delete'))
			<div class="alert alert-danger">
				<strong>Success:</strong>{!! Session::get('delete') !!}	
			</div>
		@endif
		</div>
		<div class="col-sm-4 col-sm-offset-1">
			
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#size_modal"><i class="fa fa-plus-square" aria-hidden="true"></i> New Size</button>
		<!-- Modal -->
		<div id="size_modal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
				    {!! Form::open(['route' => 'admin.product.newSize', 'method' => 'POST' , 'id' => 'size_form']) !!}
				        <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title text-center" style="color: blue">Create A New Size</h4>
				        </div>
				        <div class="modal-body">
				        	<label for="size">Size</label>
			            	<input type="text" name="size" id="size" value="{!! old('size') !!}" class="form-control">
				        </div>
				        <div class="modal-footer">
					      	<button type="button" class="btn btn-primary" id="btn_size">Create</button>
					        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				        </div>
				    {!! Form::close() !!}
				    </div>

			    </div>
			</div>
			<br>
			<br>
			<table class="table table-striped table-bordered table-hover" id="size_tbl">
		        <thead>
		            <tr class="text-center">
		                <th>ID</th>
		                <th>Size</th>
		                <th>Delete</th>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php $stt = 1; ?>
			        @foreach($sizes as $size)
			        	<tr class="text-center ck_size">
							<td>{!! $stt++ !!}</td>
			                <td>
			                	{!! $size->size !!}
			                </td>
			                <td>
			                	{!! Form::open(['route' => ['admin.sizecolor.delete', $size->id], 'method' => 'DELETE']) !!}
									<button type="submit" onclick="return deleteSize()" class="btn btn-danger">
										<i class="fa fa-trash-o"></i>
									</button>
			                	{!! Form::close() !!}
			                </td>
			            </tr>
			        @endforeach
		        </tbody>
	        </table>
		</div>
		<br>
		<br>
		<div class="col-sm-4 col-sm-offset-1">
			<table class="table table-striped table-bordered table-hover" id="color_tbl">
		        <thead>
		            <tr>
		                <th class="text-center">ID</th>
		                <th class="text-center">Color</th>
		            </tr>
		        </thead>
		        <tbody>
			        @foreach($colors as $color)
			        	<tr class="text-center">
							<td>{!! $color->id !!}</td>
			                <td>
			                	<img src="{!! asset('upload/images/colors/'.$color->color) !!}" style="width: 25px; height: 25px" alt="">
			                	<i class="fa fa-trash-o" style ="float:right;font-size: 20px"></i>
			                </td>
			            </tr>
			        @endforeach
		        </tbody>
	        </table>
		</div>
	</div>

@stop
@section('body.js')
	<script type="text/javascript" src="{!! asset('admin/javascript/myscript.js') !!}"></script>
	<script type="text/javascript">
		$('#btn_size').click(function(event) {
			var data = $('#size_form').serialize();
			$.ajax({
				url: "{{asset('admin/newsize')}}",
				type: 'POST',
				data: data,
				cache: false,
				success: function(msg){
					if(msg != 'false') {
						var act = "{{asset('admin/sizecolor/delete')}}" + "/" + msg;
						$('#size_tbl > tbody').append("<tr class='text-center ck_size'><td>"+ msg +"</td>" +
							"<td>"+$('#size').val()+"</td>" +
							"<td><form method='POST' action='"+ act +"'>" +
							"<input name='_method' type='hidden' value='DELETE'>" +
							"<input name='_token' type='hidden' value='{{csrf_token()}}' />" +
							"<button type='submit' onclick='return deleteSize();' class='btn btn-danger'>" +
							"<i class='fa fa-trash-o'></i></button></form></td></tr>");
						alert('Created New Category successfully');
						$('#size_modal').modal('hide');
					} else {
						alert('There was problem with input. Please check again!, Good buy');
					}
				}
			});
			
		});
	</script>
@stop