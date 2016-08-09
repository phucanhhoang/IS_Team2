@extends('layouts.master')
@section('title')
Stylitics - Product page
@stop

@section('breadcrumb')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Đăng ký tài khoản
</nav>
@stop

@section('content')
<div class="container">
    <div class="col-md-12" style="text-align: center; margin-top: 30px">
        <p>Đăng ký tài khoản thành công. Vui lòng kiểm tra email để kích hoạt tài khoản.</p>
        <a href="{{asset('/')}}" class="txt-link">Quay về trang chủ</a>
<!--        <a href="{{asset('auth/register/verify/sendmail/'.$email)}}" class="bt-link">Gửi lại email</a>-->
    </div>
</div>
@stop

@section('javascript')
<script>

</script>
@stop