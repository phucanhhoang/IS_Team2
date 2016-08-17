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
        <div class="heading-2">
            <span class="title-arrow">
                <span class="title-text">BẢO MẬT</span>
            </span>
        </div>
        <form id="password_form" class="col-sm-12 col-md-6" method="POST" action="{{asset('user/change_pass')}}">
            {!! csrf_field() !!}
            @if (count($errors) > 0)
            <div id="checkout_alert" class="alert alert-danger">
                <ul style="list-style-type: inherit">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session('msg'))
            <div id="checkout_alert" class="alert alert-success">
                <i class="fa fa-check"></i> {!! session('msg') !!}
            </div>
            @endif
        <table style="width:100%;font-size: 16px">
            <tr>
                <td>Tài khoản</td>
                <td>{{Auth::user()->email}}</td>
            </tr>
            <tr>
                <td>Mật khẩu</td>
                <td><input type="password" class="form-control" id="password_old" name="password_old" placeholder="Mật khẩu hiện tại của bạn" /></td>
            </tr>
            <tr>
                <td>Mật khẩu mới</td>
                <td><input type="password" class="form-control" id="password_new" name="password" placeholder="Mật khẩu từ 8 ký tự trở lên" /></td>
            </tr>
            <tr>
                <td>Xác nhận mật khẩu mới</td>
                <td><input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu mới" /></td>
            </tr>
        </table>
        <div class="row col-sm-12 col-md-12" style="margin-top: 30px"><input type="submit" value="ĐỔI MẬT KHẨU" /></div>
        </form>
<!--        <div class="heading-2">-->
<!--            <span class="title-arrow">-->
<!--                <span class="title-text">THÔNG TIN BẢO MẬT</span>-->
<!--            </span>-->
<!--        </div>-->
    </div>
</div>
@stop

@section('javascript')
<script>
    $(function(){
        $("#password_form").validate({
            rules: {
                password_old: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password_new",
                    minlength: 8
                }
            },
            messages: {
                password_old: {
                    required: "Vui lòng nhập mật khẩu hiện tại",
                    minlength: "Mật khẩu phải từ 8 ký tự trở lên"
                },
                password: {
                    required: "Vui lòng nhập mật khẩu mới",
                    minlength: "Mật khẩu phải từ 8 ký tự trở lên"
                },
                password_confirmation: {
                    required: "Vui lòng xác nhận mật khẩu mới",
                    equalTo: "Mật khẩu không khớp nhau"
                }
            }
        });
    });

</script>
@stop