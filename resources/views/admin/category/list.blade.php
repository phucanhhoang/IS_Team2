@extends('admin.master')
@section('head.title', ' | Category List')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Category
            <small>List</small>
        </h1>
    </div>
    <div class="col-sm-6">
        <form class="navbar-form navbar-right" role="search">
          <input type="text" class="form-control" placeholder="Search..">
      </form>
    </div>
   <!--  <span>Show</span>
    <select name="items" required="required">
        <option value="">5</option>
        <option value="">10</option>
        <option value="">15</option>
        <option value="">25</option>
        <option value="">50</option>
        <option value="">100</option>
    </select>
    <span>Items</span>
    <br>
    <br> -->
</div>
<div class="row col-sm-8 col-sm-offset-2">
    
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Category Name</th>
                <th class="text-center">Category Parent</th>
                <th class="text-center">Delete</th>
                <th class="text-center">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cats as $cat)
                <tr align="center">
                    <td>{!! $cat->cat_id !!}</td>
                    <td>{!! $cat->cat_title !!}</td>
                    <td>
                        @if($cat->parent_id == 0)
                            {!! "---" !!}
                        @else 
                            <?php
                                $parent = DB::table('categories')->where('cat_id', $cat->parent_id)->first();
                                echo $parent->cat_title;
                            ?>
                        @endif
                    </td>
                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.row -->
@stop