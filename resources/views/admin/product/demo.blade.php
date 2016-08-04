@extends('admin.master')
@section('head.title', ' | Size_Color')
@section('content')
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#size_modal"><i class="fa fa-plus-square" aria-hidden="true"></i> New Size</button>
<div id="size_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
		    {!! Form::open(['route' => 'admin.category.newSize', 'method' => 'POST' , 'id' => 'size_form']) !!}
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
@stop
@section('body.js')
<script type="text/javascript">
		$('#btn_newCatParent').click(function(event) {
			var data = $('#newCatParent_form').serialize();
			$.ajax({
				url: "{{asset('admin/newsize')}}",
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