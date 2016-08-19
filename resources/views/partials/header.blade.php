<header id="header" class="header header--fixed hide-from-print" role="banner">
    <nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{asset('')}}" class="navbar-brand"><img src="{{asset('assets/image/logo.png')}}"
                                                              height="40px"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNav">
                <i class="fa fa-bars fa-2x"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="myNav">
            <ul class="nav navbar-nav">
                <li><a class="active" href="{{asset('')}}">TRANG CHỦ</a></li>
                <?php
                    $cat_parents = App\Category::where('parent_id', 0)->get();
                    foreach($cat_parents as $cat_parent){
                        $cat_childs = App\Category::where('parent_id', $cat_parent->id)->get();
                        ?>
                        @if($cat_childs->count() > 0)
                        <li class="dropdown open-hover">
                            <a href="{{asset('category/'.$cat_parent->id)}}">
                                {{mb_strtoupper($cat_parent->cat_title)}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($cat_childs as $cat_child)
                                <li><a href="{{asset('category/'.$cat_child->id)}}">{{$cat_child->cat_title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li><a href="{{asset('category/'.$cat_parent->id)}}">{{strtoupper($cat_parent->cat_title)}}</a></li>
                        @endif
                        <?php
                    }
                ?>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form method="post" action="{!! url('search') !!}">
                        {!! csrf_field() !!}
                        <input type="text" id="tags" name="keyword" placeholder="Nhập từ khóa" />
                    </form>
                </li>
                <li id="cart" class="dropdown account">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart fa-2x"></i></a>
                    <?php
                        $carts = \Cart::content();
                    ?>
                    <label id="cart_num" style="{{sizeof($carts) > 0 ? 'display: block' : 'display: none'}}">{{\Cart::count()}}</label>
                    <div class="dropdown-menu arrow-box box-cart">
                        <p class="title">GIỎ HÀNG</p>
                        <table id="shopping_cart" class="table">
                            <?php
                                if(!sizeof($carts) > 0){
                                    ?>
                                    <tr>
                                        <td><h5>Bạn chưa có sản phẩm nào trong giỏ hàng.</h5></td>
                                    </tr>
                                    <?php
                                } else
                            ?>
                            <?php
                                $total_money = 0;
                                foreach($carts as $cart){
                                $price = $cart->price - $cart->discount;
                                $total_money += $cart->subtotal;
                            ?>
                            <tr class="cart_id{{$cart->rowid}}" money="{{$cart->subtotal}}">
                                <td><a class="btn_del" onclick="cart_del(this);" id="{{$cart->rowid}}" p-name="{{$cart->name}}">
                                        <i class="fa fa-times-circle"></i></a></td>
                                <td width="20%"><img src="{{asset('upload/images/'.$cart->options->image)}}"
                                         style="width: 100%;height: auto"/></td>
                                <td>
                                    {{$cart->name}}
                                    <br>
                                    <input type="number" class="qty_num qty_num{{$cart->rowid}}" id="{{$cart->rowid}}" price="{{$price}}"
                                           onkeyup="num_cart_validate(this);"
                                           onchange="qty_onchange(this);" min="1" max="20" value="{{$cart->qty}}" /> x {{number_format($price, 0, ',', '.')}}đ
                                </td>
                                <td>
                                    Size <label class="box-size">{{$cart->options->size}}</label>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>

                        <input type="hidden" id="total_money" value="{{$total_money}}" />
                        <span style="font-weight: bold;line-height: 2.8;">Tổng tiền: <label class="cart_total">{{number_format($total_money, 0, ',', '.')}}</label>đ</span>
                        <a href="{{asset('checkout')}}" class="bt-link pull-right" style="margin-bottom: 5px" >ĐẶT HÀNG</a>
                    </div>

                </li>
                <li class="dropdown account">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::check())
                        <i class="fa fa-user fa-2x" style="width:34px; float: left"></i>
                        <span class="hidden-xs" style="font-size: 14px;white-space: nowrap;float: right;max-width: 75%;position: relative;top: -3px">
                            Xin chào! <br>
                            {{ mb_convert_case(Auth::user()->name, MB_CASE_TITLE, "UTF-8") }}
                        </span>
                        @else
                        <i class="fa fa-user fa-2x" style="width:25%; float: left"></i>
                        @endif
                    </a>

                    <ul class="dropdown-menu arrow-box">
                        @if(Auth::check())
                            <li><a href="{{asset('user/info')}}">Quản lý tài khoản</a></li>
                            <li><a href="{{asset('user/order')}}">Đơn hàng của tôi</a></li>
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
</header>

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
                    <ul style="list-style-type: inherit">
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
                    <input type="hidden" name="rtn_url" value="{{URL::current()}}"/>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                               placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="chkRemember" id="chkRemember" value="1"/>
                        <label for="chkRemember" style="font-weight: normal;vertical-align: top;">Duy trì đăng
                            nhập</label>
                        <a href="{{asset('auth/password/email')}}" class="txt-link pull-right">Quên mật khẩu?</a>
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
                <h4 class="modal-title">Đăng ký thành viên</h4>
            </div>

            <div class="modal-body">
                    @if (count($errors) > 0)
                    <div id="register_alert" class="alert alert-danger">
                        <ul style="list-style-type: inherit">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form id="register_form" class="form-horizontal" role=="form" action="{{asset('auth/register')}}"
                          method="post">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <input type="hidden" name="rtn_url" value="{{URL::current()}}"/>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Họ và tên</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" placeholder="Họ và tên">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu từ 8 ký tự">
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
                                <input id="btn-register" type="submit" value="ĐĂNG KÝ" />

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

<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-2.1.4.min.js')}}"></script>
<script>
    $('#tags').keyup(function(){
        $.ajax({
            type: 'GET',
            url: "{{url('getTags')}}",
            success: function(data){
                $("#tags").autocomplete({
                    source: data
                });
            }
        });
    });

    $(document).ready(function () {

        if ({{old('openLoginModal', 'false')}})
        {
            $('#error_msg').html("{!! session('message') !!}");
            $('#login_modal').modal('show');
        }
        if ({{old('openRegisterModal', 'false')}})
        {
            $('#register_modal').modal('show');
        }

        $("div.dropdown-menu.box-cart").click(function(e) {
            e.stopPropagation();
        });

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
                    maxlength: 11,
                    remote: {
                        url: "{{asset('checkexist/phone')}}",
                        type: 'POST'
                    }
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
//                    remote:{
//                        url: "{{asset('check/captcha')}}",
//                        type: 'POST'
//                    }
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
                    required: "Vui lòng nhập số điện thoại",
                    remote: "Số điện thoại đã tồn tại"
                },
                email: {
                    required: "Vui lòng nhập E-mail",
                    email: "Vui lòng nhập đúng định dạng E-mail",
                    remote: "Địa chỉ E-mail đã tồn tại"
                },
                captcha: {
                    required: "Vui lòng nhập mã captcha",
//                    remote: "Nhập sai mã captcha"
                }
            }
        });
    });
    $('#btn-login').click(function () {
        $('#register_alert').html('');
    });
    $('#btn-register').click(function () {
        $('#login_alert').html('');
    });

    function num_cart_validate(btn){
        $(btn).val($(btn).val().replace(/[^1-9]/g,''));
    }

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

    function cart_del(btn) {
        var pro_name = $(btn).attr('p-name');
        if(confirm("Bạn chắc chắn muốn xóa [ "+ pro_name +" ] khỏi giỏ hàng?")){
            var cart_id = $(btn).attr('id');
            $.ajax({
                type: 'POST',
                url: "{{asset('cart/delete')}}",
                data: {id: cart_id},
                cache: false,
                success: function(msg){
                    if (msg === 'true') {
                        $('.cart_id' + cart_id).fadeOut(function () {
                            $(this).remove();
                        });
                        var total_money = parseInt($('#total_money').val()) - parseInt($(btn).parents('tr').attr('money'));
                        $('#total_money').val(total_money);
                        total_money = accounting.formatNumber(total_money, 0, ".", ",");
                        $('.cart_total').html(total_money);
                        var cart_num = parseInt($('#cart_num').html()) - parseInt($($('.cart_id' + cart_id).find('input')[0]).val());
                        $('#cart_num').html(cart_num);
                        if(cart_num == 0){
                            $('#cart_num').hide();
                            if("{{URL::current()}}" == "{{asset('checkout')}}")
                                location.reload();
                        }
                    }
                    else{
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                    }
                }
            });
        }
    }

    function qty_onchange(num){
        var cart_id = $(num).attr('id');
        $('.qty_num' + cart_id).val($(num).val());
        var qty = $(num).val();
        $.ajax({
            type: 'POST',
            url: "{{asset('cart/change')}}",
            data: {id: cart_id, quantity: qty},
            cache: false,
            success: function(data){
                console.log(data);
                if(data['msg'] == 'true'){
                    $('#cart_num').html(parseInt(data['count']));
                    var money = parseInt(data['money']);
                    var total_money = parseInt(data['subtotal']);
                    $(num).parents('tr').attr('money', money);
                    $('#total_money').val(total_money);
                    money = accounting.formatNumber(money, 0, ".", ",");
                    total_money = accounting.formatNumber(total_money, 0, ".", ",");

                    $('#order_table > tbody > tr.cart_id'+ cart_id +' > td:last-child').html(money + ' đ');
                    $('.cart_total').html(total_money);
                }
                else{
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            }
        });
    }
</script>
