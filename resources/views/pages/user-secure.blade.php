@extends('layouts.master')
@section('title')
Stylitics - User page
@stop

@section('breadcrumb')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Hồ sơ cá nhân
</nav>
@stop

@section('content')
<div class="container">
    <div class="col-sm-3 col-md-3 user">
        <ul>
            <a href="{{asset('user/info')}}"><li><i class="fa fa-user"></i>THÔNG TIN CƠ BẢN</li></a>
            <a href="{{asset('user/secure')}}"><li class="state-focus"><i class="fa fa-lock"></i>BẢO MẬT VÀ MẬT KHẨU</li></a>
            <a href="{{asset('user/order')}}"><li><i class="fa fa-calendar"></i>LỊCH SỬ ĐƠN HÀNG</li></a>
        </ul>
    </div>
    <div class="col-sm-9 col-md-9">

    </div>
</div>
@stop

@section('javascript')
<script>

</script>
@stop