@extends('admin.master')
@section('head.title', ' | Category List')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <h1 class="lead" style="font-size: 2em; color:rgb(255,0,0)">Product
            <small>List</small>
        </h1>
    </div>
    <div class="col-sm-6">
        <form class="navbar-form navbar-right" role="search">
          <input type="text" class="form-control" placeholder="Search..">
      </form>
    </div>
</div>
<div class="row">
    <span>Show</span>
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
    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Product Code</th>
                <th class="text-center">price</th>
                <th class="text-center">Discount</th>
                <th class="text-center">Product Image</th>
                <th class="text-center">Delete</th>
                <th class="text-center">Edit</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $pro)
            <tr align="center">
                <td>{!! $pro->pro_id !!}</td>
                <td>{!! $pro->pro_name !!}</td>
                <td>{!! $pro->pro_code !!}</td>
                <td>{!! $pro->price !!}</td>
                <td>{!! $pro->discount !!}</td>
                <td><img src="{!! url('resources/upload/images',$pro->image) !!}" alt="" width="200"; height="200"></td>
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- /.row -->

@stop