<div class="col-sm-3">
    <div class="main-sidebar filter">
        <p class="title">DANH MỤC SẢN PHẨM</p>
        <section class="sidebar">
        <ul class="sidebar-menu" id="category">
            @foreach (App\Category::where('parent_id', 0)->orderBy('cat_title')->get() as $cat_parent)
            <li class="treeview">
                <span class="tree-item">
                    <a href="{{asset('category/'.$cat_parent->id)}}" cat_type="parent">{{mb_convert_case($cat_parent->cat_title, MB_CASE_TITLE, "UTF-8")}}</a>
                </span>
                <?php
                $cat_childs = App\Category::where('parent_id', $cat_parent->id)->get();
                ?>
                @if($cat_childs->count() > 0)
                <a href="#">
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    @foreach($cat_childs as $cat_child)
                    <li><a href="{{asset('category/'.$cat_child->id)}}" cat_type="child">{{mb_convert_case($cat_child->cat_title, MB_CASE_TITLE, "UTF-8")}}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
            </section>

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
                        ?>
                        <input type="checkbox" name="color_id" class="chk_color" value="{{$color->id}}" id="{{'ms-check'.$stt}}"/>
                        <label for="{{'ms-check'.$stt}}" style="background-color: <?php echo $color->color ?>"></label>

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
                        <input type="checkbox" name="kichco" class="chk_size" value="{{$size->id}}" id="{{'kc-check'.$stt}}"/>
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

<script>
    $(function(){
        var cur_url = decodeURIComponent("{{URL::current()}}");
        var cat = $('#category').find("a[href='"+ cur_url +"']")[0];
        $(cat).addClass('active');
        if($(cat).attr('cat_type') == 'child'){
            $(cat).parents('li.treeview').addClass('active');
            $(cat).parents('ul.treeview-menu').show();
        }
        else{
            $(cat).parents('li.treeview').addClass('active');
            $(cat).parents('li.treeview').children('ul').show();
        }
    });
</script>