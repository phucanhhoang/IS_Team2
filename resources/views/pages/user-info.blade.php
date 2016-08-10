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
            $customer = App\Customer::find(Auth::user()->userable_id);
        ?>
        <table id="user_info_table" class="col-sm-6 col-md-6">
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
                    <input type="text" name="phone" value="{{$customer->phone}}" class="form-control" style="display: none" />
                </td>
            </tr>
            <tr>
                <td>Tỉnh/Thành phố:</td>
                <td>
                    <label>{{$province}}</label>
                    <select class="form-control" id="province" name="province" style="display: none">
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
        <div class="row col-sm-12 col-md-12" style="margin-top: 30px"><input type="button" id="btn_edit" value="CHỈNH SỬA" /></div>
    </div>

</div>
@stop

@section('javascript')
<script>
$('#btn_edit').click(function(){
    $('#user_info_table').find('label').hide();
    $('#user_info_table').find('input[type=text], select').show();
});
</script>
@stop