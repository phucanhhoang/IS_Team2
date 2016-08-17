@extends('layouts.master')

@section('breadcrumb')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Quên mật khẩu
</nav>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Đổi mật khẩu</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div id="register_alert" class="alert alert-danger">
                        <ul style="list-style-type: inherit">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form id="reset_pass_form" class="form-horizontal" role="form" method="POST" action="{{ url('auth/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}" />
                        <input type="hidden" name="email" value="{{ $email }}" />
                        <input type="hidden" name="rtn_url" value="{{URL::current().'?email='.$email}}"/>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tài khoản</label>

                            <div class="col-md-6" style="padding-top: 7px">
                                <label>{{$email}}</label>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật khẩu mới</label>

                            <div class="col-md-6">
                                <input id="password_new" type="password" class="form-control" name="password" />
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Xác nhận mật khẩu mới</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit">
                                    <i class="fa fa-btn fa-refresh"></i> ĐỔI MẬT KHẨU
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $(function(){
        $("#reset_pass_form").validate({
            rules: {
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
                password: {
                    required: "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu phải từ 8 ký tự trở lên"
                },
                password_confirmation: {
                    required: "Vui lòng xác nhận mật khẩu",
                    equalTo: "Mật khẩu không khớp nhau"
                }
            }
        });
    });
</script>
@stop
