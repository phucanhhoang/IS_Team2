@extends('admin.master')
@section('head.title', ' | Add Category')
@section('content')
<div class="row">
<div class="col-lg-6 col-lg-offset-3">
	<div class="panel panel-primary">
		<div class="panel-heading text-center">Add Category</div>
		<div class="panel-body">
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
			<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.category.postAddCat') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="cat_title" class="control-label">Category Name</label>
					<input  type="text" class="form-control" name="cat_title" value="{{ old('cat_title') }}">
					<!-- <select name="sel_parent" class="form-control">
						<option value="">Please enter the category name</option>
						<?php cat_parent($parent); ?>
					</select> -->
                </div>
                <div class="form-group">
                    <label for="sel_parent" class="control-label">Category Parent</label>
					<input  type="text" class="form-control" name="parent_id" value="{{ old('parent_id') }}">
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input type="submit" value="Add Category" class="btn btn-primary">
					</div>
					<div class="col-sm-6 text-right">
						<input type="reset" value="Clear Data" class="btn btn-danger">
					</div>
					<div class="col-sm-6"></div>
				</div>
            </form>
		</div>
	</div>
</div>
</div>
@stop