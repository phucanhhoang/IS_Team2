<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body>
@if (session('message'))
<div id="myAlert" class="alert {{session('alert-class')}} alert-dismissable fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa {{session('fa-class')}}"></i> {{ session('message') }}
</div>
@endif
<form id="login_form" method="post" action="{{asset('auth/register')}}">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
    <input type="hidden" name="rtn_url" value="{{URL::previous()}}"/>
    @if (count($errors) > 0)
    <p>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </p>
    @endif
    <p>
        <label>Họ tên</label>
        <input type="text" name="name" id="name" value="{{old('name')}}"/>
    </p>
    <p>
        <label>Mật khẩu</label>
        <input type="password" name="password" id="password"/>
    </p>
    <p>
        <label>Xác nhận mật khẩu</label>
        <input type="password" name="password_confirmation" id="password_confirmation"/>
    </p>
    <p>
        <label>Số điện thoại</label>
        <input type="text" name="phone" id="phone" value="{{old('phone')}}"/>
    </p>
    <p>
        <label>E-mail</label>
        <input type="email" name="email" id="email" value="{{old('email')}}"/>
    </p>
    <p>
        {!! Captcha::img() !!} <input name="captcha" type="text"/>
        @if ($errors->has('captcha'))
    <div class="error-messages">{{ $errors->first('captcha') }}</div>
    @endif
    </p>
    <input type="submit"/>

</form>
</body>
</html>
