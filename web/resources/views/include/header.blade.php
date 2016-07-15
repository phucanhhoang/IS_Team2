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
                <li id="cart" class="fa fa-shopping-cart fa-2x">
                    <span id="cart-num">2</span>
                </li>
                <li class="dropdown account">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-2x"></i></a>
                    <ul class="dropdown-menu">
                        @if(Auth::check())
                        <li><span>Tổng điểm bạn có: <span>0</span></span></li>
                        <li><a href="#">Quản lý tài khoản</a></li>
                        <li><a href="#">Đơn hàng của tôi</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{asset('auth/logout')}}">Đăng xuất</a></li>
                        @else
                        <li><a href="#" id="btn-login" data-toggle="modal" data-target="#login_modal">Đăng nhập</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{asset('auth/register')}}">Đăng ký thành viên</a></li>
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
            <div class="panel panel-info">
                <div id="login-panel-heading" class="panel-heading">
                    <div id="login-panel-title" class="panel-title">Đăng nhập tài khoản</div>
                    <!--				<div id="forget_pass"><a href="">Quên mật khẩu?</a></div>  -->
                </div>

                <div id="login_body" class="panel-body" style="padding-top: 0">
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
                        <div class="form-group">
                            <a href="{{ url('auth/facebook') }}" class="bt-link bt-blue"><i class="fa fa-facebook"
                                                                                            aria-hidden="true"></i>Đăng
                                nhập bằng Facebook</a>
                        </div>
                        <div class="form-group">
                            <div id="dont-have-account">
                                Chưa có tài khoản!
                                <a href=""> Đăng ký</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>