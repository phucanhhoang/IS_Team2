@extends('admin.master')
@section('head.title', ' | Category List')
@section('content')
@section('style')
<style>
    #dataTable_filter label {
        float: right !important;
    }
</style>
@stop
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{!! url('admin/home') !!}">Admin</a></li>
      <li><a href="{!! url('admin/category') !!}">Category</a></li>
      <li class="active">List</li>
    </ol>
</div>
<div class="row">
    <a href="{!! route('admin.category.create') !!}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Create New Category</a>
</div>
<div class="row">
    <div class="col-sm-12">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Category
            <small>List</small>
        </h1>
    </div>
</div>
@include('admin.message')
<div class="row col-sm-8 col-sm-offset-2">
   <table class="table table-striped table-bordered" id="dataTable">
        <thead>
        <tr align="center">
            <th>STT</th>
            <th>Category Name</th>
            <th>Parent Category</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
            <?php $stt = 1; ?>
            @foreach($cats as $cat)
                <tr>
                    <td class="text-center">{!! $stt++ !!}</td>
                    <td>{!! $cat->cat_title !!}</td>
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
                    <td class="text-center">
                        <?php
                            $parent = DB::table('categories')->where('parent_id', '=', $cat->id)->get();
                        ?>
                        @if($cat->parent_id == 0 && $parent) 
                            {!! '<button type="submit" class="btn btn-danger" disabled="disabled"><i class="fa fa-trash-o  fa-fw"></i> Delete</button>'; !!}
                        @else 
                            {!! Form::open(['route' => ['admin.category.destroy',$cat->id], 'method' => 'DELETE']) !!}
                                <button type="submit" class="btn btn-danger" onclick="return deleteCat()"><i class="fa fa-trash-o  fa-fw"></i> Delete</button>
                            {!! Form::close() !!}
                        
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{!! route('admin.category.edit',$cat->id) !!}" class="btn btn-info"><i class="fa fa-pencil fa-fw"></i> Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.row -->
@stop
@section('body.js')
    <script type="text/javascript" src="{!! asset('admin/javascript/myscript.js') !!}"></script>
@stop
