<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{asset('')}}" class="navbar-brand"><img src="{{asset('../resources/assets/image/logo.png')}}"
                                                              height="50px"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNav">
                <i class="fa fa-bars fa-2x"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="myNav">
            <ul class="nav navbar-nav">
                <li><a class="active" href="{{asset('')}}">TRANG CHỦ</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ÁO <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Áo phông</a></li>
                        <li><a href="#">Áo sơ-mi</a></li>
                    </ul>
                </li>
                <li><a href="#">VÁY</a></li>
                <li><a href="#">QUẦN</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><input type="text"/></li>
                <li id="cart">
                    <a href="{{asset('cart')}}"><i class="fa fa-shopping-cart fa-2x"></i></a>
                    <span id="cart-num">2</span>
                </li>
                <li class="dropdown account">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-2x"></i></a>
                    <ul class="dropdown-menu">
                        @if(Auth::check())
                        <li><a href="#">Quản lý tài khoản</a></li>
                        <li><a href="#">Đơn hàng của tôi</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{asset('auth/logout')}}">Đăng xuất</a></li>
                        @else
                        <li><a href="#" id="btn-login" data-toggle="modal" data-target="#login_modal">Đăng nhập</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#" id="btn-register" data-toggle="modal" data-target="#register_modal">Đăng ký thành viên</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal" id="login_modal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 500px">
        <div id="login" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Đăng nhập tài khoản</h4>
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                <div id="login_alert" class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <label id="error_msg" class="error" style="margin-bottom: 15px"></label>
                <form id="login_form" class="form-horizontal" role="form" action="{{asset('auth/login')}}"
                      method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <input type="hidden" name="rtn_url" value="{{URL::previous()}}"/>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="{{old('email')}}"
                               placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="chkRemember" id="chkRemember" value="1"/>
                        <label for="chkRemember" style="font-weight: normal;vertical-align: top;">Duy trì đăng
                            nhập</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" style="width: 100%" value="ĐĂNG NHẬP"/>
                    </div>
                </form>
                <div class="form-group">
                    <a href="{{ url('auth/facebook') }}" class="bt-link bt-blue">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        Đăng nhập bằng Facebook</a>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    Chưa có tài khoản!
                    <a href="javascript:void(0)" id="link_to_register" data-toggle="modal" data-target="#register_modal" class="txt-link"> Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="register_modal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Đăng nhập tài khoản</h4>
            </div>

            <div class="modal-body">
                    @if (count($errors) > 0)
                    <div id="login_alert" class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form id="register_form" class="form-horizontal" role=="form" action="{{asset('auth/register')}}"
                          method="post">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <input type="hidden" name="rtn_url" value="{{URL::previous()}}"/>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Họ và tên</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" placeholder="Họ và tên">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu từ 8 ký tự">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-4 control-label">Nhập lại mật khẩu</label>
                            <div class="col-md-8">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Số điện thoại</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" placeholder="Địa chỉ Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4" >
                                <a href="javascript:void(0)" onclick="refreshCaptcha()" class="pull-right"
                                   style="margin-left: 15px;margin-top: 8px"><i class="fa fa-refresh"></i></a>
                                <div id="refereshrecapcha" class="pull-right">
                                    {!! captcha_img() !!}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input name="captcha" type="text" class="form-control" placeholder="Nhập mã captcha"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-8">
                                <input id="btn-register" type="submit" name="register" value="ĐĂNG KÝ" />

                            </div>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <div style="text-align: left">
                    Đã có tài khoản!
                    <a href="javascript:void(0)" id="link_to_login" data-toggle="modal" data-target="#login_modal" class="txt-link"> Đăng nhập</a>
                    <br /><br />
                    <a href="{{ url('auth/facebook') }}" class="bt-link bt-blue">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        Đăng nhập bằng Facebook</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('../resources/assets/js/jquery/jquery-2.1.4.min.js')}}"></script>
<script>
    function refreshCaptcha() {
        $.ajax({
            url: "{{asset('refereshcapcha')}}",
            type: 'get',
            dataType: 'html',
            success: function (json) {
                $('#refereshrecapcha').html(json);
            },
            error: function (data) {
                alert('Try Again.');
            }
        });
    }
    $('#link_to_login').click(function(){
        $('#register_modal').modal('hide');
    });
    $('#link_to_register').click(function(){
        $('#login_modal').modal('hide');
    });
</script>