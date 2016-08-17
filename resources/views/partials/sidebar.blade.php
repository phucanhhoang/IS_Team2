<div class="col-sm-3">
    <div class="col-sm-12 filter">
        <p class="title">DANH MỤC SẢN PHẨM</p>
        <ul class="p-menu">
            <?php
            $cat_childs = App\Category::where('parent_id', '!=', 0)->orderBy('parent_id')->get();
            foreach($cat_childs as $cat_child){
            ?>
            <li><a href="{{asset('category/'.$cat_child->id.'/'.$cat_child->cat_title)}}">{{$cat_child->cat_title}}</a></li>
            <?php } ?>
        </ul>

        <p class="title">TÌM KIẾM THEO</p>
        <form>
            <div style="margin-bottom: 10px">
                <p class="title">Màu sắc</p>
                <div class="mausac">
                    <?php
                    $img_colors = App\Image::join('colors', 'colors.id', '=', 'images.color_id')->get();
                    $stt = 0;
                    foreach($img_colors as $color){
                        $stt++;
                        $url_img = asset('upload/images/colors/'.$color->color);
                        ?>
                        <input type="checkbox" name="color_id" class="chk_color" value="{{$color->color_id}}" id="{{'ms-check'.$stt}}"/>
                        <label for="{{'ms-check'.$stt}}" style="background-image: url('<?php echo $url_img ?>')"></label>

                    <?php } ?>
                </div>
            </div>

            <div style="margin-bottom: 10px">
                <p class="title">Kích cỡ</p>
                <div class="kichco">
                    <?php
                    $sizes = App\Size::orderBy('size')->get();
                    $stt = 0;
                    foreach($sizes as $size){
                        $stt++;
                        ?>
                        <input type="checkbox" name="kichco" class="chk_color" value="{{$size->id}}" id="{{'kc-check'.$stt}}"/>
                        <label for="{{'kc-check'.$stt}}">{{$size->size}}</label>

                    <?php } ?>
                </div>
            </div>

            <div style="margin-bottom: 30px">
                <p class="title">
                    <label for="amount">Giá</label>
{{--
                    <input type="text" id="amount" style="font-size: small; font-weight: normal; margin-left: 15px" readonly/>
                </p>
                <div id="slider-range"></div>
            </div>
            <a href="javacsript: void(0)" id="btnGui" class="btn btn-danger" type="button">TÌM KIẾM</a>
--}}
                <ul id="filter_price">
                    <li><a href="{{ asset('category/'.$cate_id.'/filter/0/100000')}}"> 0 - 100.000 đ</a></li>
                    <li><a href="{{ asset('category/'.$cate_id.'/filter/100000/300000')}}"> 100.000 đ - 300.000 đ</a></li>
                    <li><a href="{{ asset('category/'.$cate_id.'/filter/300000/500000')}}"> 300.000 đ - 500.000 đ</a></li>
                    <li><a href="{{ asset('category/'.$cate_id.'/filter/500000/1000000')}}"> 500.000 đ - 1.000.000 đ</a></li>
                </ul>
            </div>
        </form>
    </div>
</div>
