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
            <a href="{{asset('user/info')}}"><li class="state-focus"><i class="fa fa-user"></i>THÔNG TIN CÁ NHÂN</li></a>
            <a href="{{asset('user/secure')}}"><li><i class="fa fa-lock"></i>BẢO MẬT VÀ MẬT KHẨU</li></a>
            <a href="{{asset('user/order')}}"><li><i class="fa fa-calendar"></i>LỊCH SỬ ĐƠN HÀNG</li></a>
        </ul>
    </div>
    <div class="col-sm-9 col-md-9">
        <div class="heading-2">
            <span class="title-arrow">
                <span class="title-text">THÔNG TIN CÁ NHÂN</span>
            </span>
        </div>
        <?php
//            $customer = App\Customer::find(Auth::user()->userable_id);
        ?>
        <div class="col-sm-12 col-md-6">
        <form id="user_form" method="post" action="{{asset('user/save_user_info')}}">
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
            <div id="update_user_alert" class="alert alert-success">
                <i class="fa fa-check"></i> {!! session('msg') !!}
            </div>
            @endif
        <table id="user_info_table" style="width: 100%;font-size: 16px">
            <tr>
                <td width="150">Họ tên:</td>
                <td>
                    <label>{{$customer->name}}</label>
                    <input type="text" name="name" value="{{$customer->name}}" class="form-control" style="display: none" />
                </td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td>
                    <label>{{$customer->phone}}</label>
                    <input type="text" id="phone" name="phone" value="{{$customer->phone}}" class="form-control" style="display: none" />
                    <label id="phone-msg" class="error" style="display: none" for="phone"></label>
                </td>
            </tr>
            <tr>
                <td>Tỉnh/Thành phố:</td>
                <td>
                    <label>@if($province){{$province}}@endif</label>
                    <select class="form-control" id="province" name="province" onchange="province_onchange(this);" style="display: none">
                        <option value="">Tỉnh/Thành phố</option>
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}">{{mb_convert_case($province->name, MB_CASE_TITLE, "UTF-8")}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Quận/Huyện:</td>
                <td>
                    <label>{{$district}}</label>
                    <select class="form-control" id="district" name="district" style="display: none">
                        <option value="">Quận/Huyện</option>
                        @foreach($districts as $district)
                        <option value="{{$district->id}}">{{mb_convert_case($district->name, MB_CASE_TITLE, "UTF-8")}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td>
                    <label>{{$customer->address}}</label>
                    <input type="text" name="address" value="{{$customer->address}}" class="form-control" style="display: none" />
                </td>
            </tr>

        </table>
        <div class="row col-sm-12 col-md-12" style="margin-top: 30px">
            <input type="button" id="btn_edit" onclick='update_user_info(this);' value="CHỈNH SỬA" />
        </div>
        </form>
        </div>
    </div>

</div>
@stop

@section('javascript')
<script>

    $(function(){
        $('#province').val("{{$customer->province_id != 0 ? $customer->province_id : ''}}");
        $('#district').val("{{$customer->district_id != 0 ? $customer->district_id : ''}}");


        $('#user_form').validate({
            rules: {
                name: 'required',
                phone: {
                    required: true,
                    phoneno: true,
                    minlength: 10,
                    maxlength: 11,
                },
                province: 'required',
                district: 'required',
                address: 'required'
            },
            messages:{
                name: "Vui lòng nhập họ tên",
                phone: {
                    required: "Vui lòng nhập số điện thoại",
                },
                province: 'Vui lòng chọn tỉnh thành',
                district: 'Vui lòng chọn quận huyện',
                address: 'Vui lòng nhập địa chỉ'
            }
        });
    });

    $('#phone').blur(function(){
        if($('#phone').val() != "{{$customer->phone}}"){
            $.ajax({
                type: "POST",
                url: "{{asset('checkexist/phone')}}",
                data: {phone: $('#phone').val()},
                success: function(msg){
                    if(msg == 'false'){
                        $('#phone-msg').html("Số điện thoại đã tồn tại");
                        $('#phone-msg').show();
                        $('#submit_info').attr('type', 'button');
                    }
                    else {
                        $('#phone-msg').hide();
                        $('#submit_info').attr('type', 'submit');
                    }
                }
            });
        }
        else
            $('#phone-msg').hide();
    });

    function update_user_info(btn){
        $('#user_info_table').find('label').hide();
        $('#update_user_alert').hide();
        $('#user_info_table').find('input[type=text], select').show();

        $(btn).parent().html("<input type='submit' id='submit_info' value='CẬP NHẬT' style='margin-right: 10px' />" +
            "<input type='button' id='btn_cancel' onclick='cancel_update_user_info(this);' value='HỦY'>");
    }
    function cancel_update_user_info(btn){
        $('#user_info_table').find('input[type=text], select').hide();
        $('#user_info_table').find('label').show();
        $(btn).parent().html("<input type='button' id='btn_edit' onclick='update_user_info(this);' value='CHỈNH SỬA' />");
    }
</script>
@stop