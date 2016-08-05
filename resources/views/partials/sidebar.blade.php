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
                    $img_colors = App\Color::all();
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
                    <label for="amount">Khoảng giá</label>
                    <input type="text" id="amount" style="font-size: small; font-weight: normal; margin-left: 15px" readonly/>
                </p>
                <div id="slider-range"></div>
            </div>
            <p id="btnGui"><input type="submit" value="TÌM KIẾM"></p>
        </form>
    </div>
</div>
