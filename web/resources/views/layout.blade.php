<?php
/*layout chung trong project 
 *gom co 
 		header
 			--logo
 			--signin, signout
 			--navigator
 		body
 			--sidebar --content
 		footer	
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css"
          href="{{asset('../resources/assets/css/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('../resources/assets/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('../resources/assets/css/css.css')}}"/>

    @yield('style')
</head>
<body>
<!-- <input type="hidden" id="_token" name='_token' value="{{ csrf_token() }}"/> -->

<!--header outside class container because header in full screens-->
@include('include.header')
@if (session('message'))
<div class="alert {{session('alert-class')}} alert-dismissable fade in"
     style="position: fixed;top: 10px;left: 30%;width: 40%;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa {{session('fa-class')}}"></i> {{ session('message') }}
</div>
@endif
{{-- Content --}}
    <!--sidebar content-->
    <!-- <div id="sidebar" class='col-md-3 col-sm-3 hidden-xs'>@include('include.sidebar')</div> -->

    <!--main content-->
    <!-- <div id='content' class='col-md-9 col-sm-9'> -->
    @yield('content')
    <!-- </div> -->

{{-- Footer --}}
@include('include.footer')
<script type="text/javascript" src="{{asset('../resources/assets/js/jquery/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('../resources/assets/js/jquery/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('../resources/assets/js/jquery/jquery-ui.js')}}"/></script>
<script type="text/javascript" src="{{asset('../resources/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('../resources/assets/js/back-to-top.js')}}"></script>
<script type="text/javascript" src="{{asset('../resources/assets/js/site.js')}}"></script>
<script>
    $(document).ready(function () {
        if ({{Input::old('autoOpenModal', 'false')}})
        {
            $('#error_msg').html('E-mail hoặc mật khẩu không chính xác.');
            $('#login_modal').modal('show');
        }
        //----------------Validate form--------------------//
        $("#login_form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Vui lòng nhập E-mail",
                    email: "Vui lòng nhập đúng định dạng E-mail"
                },
                password: {
                    required: "Vui lòng nhập Password"
                }
            }
        });
        jQuery.validator.addMethod("phoneno", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
        }, "Vui lòng nhập đúng số điện thoại");
        $("#register_form").validate({
            rules: {
                name: 'required',
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password",
                    minlength: 8
                },
                phone: {
                    required: true,
                    phoneno: true,
                    minlength: 10,
                    maxlength: 11
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{asset('checkexist/email')}}",
                        type: 'POST'
                    }
                },
                captcha: {
                    required: true,
                    remote:{
                        url: "{{asset('check/captcha')}}",
                        type: 'POST'
                    }
                }
            },
            messages: {
                name: "Vui lòng nhập họ tên",
                password: {
                    required: "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu phải từ 8 ký tự trở lên"
                },
                password_confirmation: {
                    required: "Vui lòng xác nhận mật khẩu",
                    equalTo: "Mật khẩu không khớp nhau"
                },
                phone: {
                    required: "Vui lòng nhập số điện thoại"
                },
                email: {
                    required: "Vui lòng nhập E-mail",
                    email: "Vui lòng nhập đúng định dạng E-mail",
                    remote: "Địa chỉ E-mail đã tồn tại"
                },
                captcha: {
                    required: "Vui lòng nhập mã captcha",
                    remote: "Nhập sai mã captcha"
                }
            }
        });
    });
    $('#btn-login').click(function () {
        $('#error_msg').html('');
    });
</script>
@yield('javascript')


</body>
</html>