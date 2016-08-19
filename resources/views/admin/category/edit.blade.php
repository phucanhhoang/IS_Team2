@extends('admin.master')
@section('head.title', ' | Edit a category')
@section('content')
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
      <li><a href="{!! url('admin/category') !!}">Category</a></li>
      <li class="active">Edit</li>
    </ol>
</div>
	
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading text-center" style="font-size: 20px">Edit category</div>
            <div class="panel-body">
                {!! Form::model($cat,['route' => ['admin.category.update',$cat->id], 'method' => 'PUT', 'id' => 'cat_form']) !!}
					<div class="form-group">
						{!! Form::label('cat_title', 'Category Name' ,['class' => 'control-label']) !!}
						{!! Form::text('cat_title', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('parent_id', 'Parent Name' ,['class' => 'control-label']) !!}
						@if($cat->parent_id == 0)
                            <?php 
                            echo '<input type= "text" value="None" disabled="disable" class = "form-control" />'; 
                            ?>
                        @else 
	                       	<?php
                                $parent = DB::table('categories')->where('id', $cat->parent_id)->first();
                                echo '<input type= "text" value="'.$parent->cat_title.'" disabled="disable" class = "form-control" />';
                            ?>
                        @endif
					</div>
						{!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
						<a href="{!! route('admin.category.index') !!}" class="btn btn-danger">Cancel</a>
					
						
					</div>
				{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
@section('body.js')
    <script type="text/javascript">
        $("#cat_form").validate({
            rules:{
                cat_title: 'required'
            }
        });
    </script>
@stop