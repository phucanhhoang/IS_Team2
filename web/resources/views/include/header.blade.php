<header class="col-12">
    <div class='info'>
        <div class="dropdown">
            @if(Auth::check())
            <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-user"></i> {{App\Customer::find(Auth::user()->userable_id)->name}}
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><span>Tổng điểm bạn có: <span>0</span></span></li>
                <li><a href="#">Quản lý tài khoản</a></li>
                <li><a href="#">Đơn hàng của tôi</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{asset('auth/logout')}}">Đăng xuất</a></li>
            </ul>
        <!--        <a href="{{asset('auth/logout')}}">Đăng xuất</a>-->
        @else
            <!--            <p><a href="{{asset('auth/login')}}">Đăng nhập</a> | <a href="{{asset('auth/register')}}">Đăng ký </a></p>-->
            <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-user"></i> Tài khoản
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a href="{{asset('auth/login')}}">Đăng nhập</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{asset('auth/register')}}">Đăng ký thành viên</a></li>
            </ul>
        @endif
            | <a href="#"><i class="fa fa-shopping-bag"></i> GIỎ HÀNG</a> | 0 sản phẩm | 0 đồng
        </div>

        <p>
            <input type="text" name="txtSearch" placeholder="Tìm kiếm..."/>
            <a href="#" style="position: absolute;right: 10px;top: 6px;"><i class="fa fa-search"></i></a>
        </p>
    </div>

    <div class='logo'>
        <img src="{{asset('../resources/assets/image/logo.png')}}"/>
    </div>
</header>