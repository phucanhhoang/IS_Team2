<header class="col-12">
    <div class='info'>
        @if(Auth::check())
        <div class="dropdown">
            <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-user"></i> <b>{{Auth::user()->username}}</b>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>

        <!--        <a href="{{asset('auth/logout')}}">Đăng xuất</a>-->
        @else
        <p><a href="{{asset('auth/login')}}">Đăng nhập</a> | <a href="#">Đăng ký</a></p>
        @endif
        <p>
            <input type="text" name="txtSearch" placeholder="Tìm kiếm..."/>
            <a href="#" style="position: relative;right: 24px;"><i class="fa fa-search"></i></a>
            <a href="#"><i class="fa fa-shopping-bag"></i> GIỎ HÀNG</a> | 0 sản phẩm | 0 đồng
        </p>
    </div>

    <div class='logo'>
        <img src="{{asset('../resources/assets/image/logo.png')}}"/>
    </div>
</header>