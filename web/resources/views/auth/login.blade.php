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
<form id="login_form" method="post" action="{{asset('auth/login')}}">
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
        <label>E-mail</label>
        <input type="email" name="email" id="email"/>
    </p>
    <p>
        <label>Password</label>
        <input type="password" name="password" id="password"/>
    </p>
    <p><input type="checkbox" name="chkRemember" id="chkRemember"/> <label for="chkRemember">Remember Me?</label></p>
    <input type="submit"/>

</form>
</body>
</html>
