<div class="col-sm-3">
    <div class="col-sm-12 filter" style="margin-bottom: 25px;">
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
        <form id="filter_form">
            {!! csrf_field() !!}
            <input type="hidden" id="strColorId" name="strColorId"/>
            <input type="hidden" id="strSizeId" name="strSizeId"/>
            <input type="hidden" id="price_from" name="price_from" value="0"/>
            <input type="hidden" id="price_to" name="price_to" value="0"/>
            <div style="margin-bottom: 10px">
                <p class="title">Màu sắc</p>
                <div class="mausac">
                    <?php
                    $img_colors = App\Color::all();
                    $stt = 0;
                    foreach($img_colors as $color){
                        $stt++;
                        ?>
                        <input type="checkbox" class="chk_color" value="{{$color->id}}" id="{{'ms-check'.$stt}}"/>
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
                        <input type="checkbox" class="chk_size" value="{{$size->id}}" id="{{'kc-check'.$stt}}"/>
                        <label for="{{'kc-check'.$stt}}">{{$size->size}}</label>

                    <?php } ?>
                </div>
            </div>

            <div style="margin-bottom: 30px">
                <p class="title">
                    <label for="amount">Giá</label>
                    <input type="text" id="amount" style="font-size: small; font-weight: normal; margin-left: 15px" readonly/>
                </p>
                <div id="slider-range"></div>
            </div>
            {{--
            <a href="javacsript: void(0)" id="btnGui" class="btn btn-danger" type="button">TÌM KIẾM</a>
--}}
<!--                <ul id="filter_price">-->
<!--                    <li><a href="{{ asset('category/'.$cate_id.'/filter/0/100000')}}"> 0 - 100.000 đ</a></li>-->
<!--                    <li><a href="{{ asset('category/'.$cate_id.'/filter/100000/300000')}}"> 100.000 đ - 300.000 đ</a></li>-->
<!--                    <li><a href="{{ asset('category/'.$cate_id.'/filter/300000/500000')}}"> 300.000 đ - 500.000 đ</a></li>-->
<!--                    <li><a href="{{ asset('category/'.$cate_id.'/filter/500000/1000000')}}"> 500.000 đ - 1.000.000 đ</a></li>-->
<!--                </ul>-->

            <input type="button" id="btnFilter" value="ÁP DỤNG LỌC" />
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

        //Price range
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1000000,
            slide: function (event, ui) {
                $('#price_from').val(ui.values[0]);
                $('#price_to').val(ui.values[1]);
                var from = accounting.formatNumber(ui.values[0], 0, '.', ',');
                var to = accounting.formatNumber(ui.values[1], 0, '.', ',');
                $("#amount").val(from + "đ - " + to + "đ");
            }
        });
        $("#amount").val($("#slider-range").slider("values", 0) +
            "đ - " + $("#slider-range").slider("values", 1) + "đ");
    });

    $("#btnFilter").click(function(){
        var strColorId = '';
        var strSizeId = '';
        $('.chk_color').each(function(){
            if($(this).prop('checked')){
                strColorId += $(this).val() + ';';
            }
        });
        $('#strColorId').val(strColorId);
        $('.chk_size').each(function(){
            if($(this).prop('checked')){
                strSizeId += $(this).val() + ';';
            }
        });
        $('#strSizeId').val(strSizeId);

        var data = $('#filter_form').serialize();
        $.ajax({
            type: 'POST',
            url: "{{URL::current()}}",
            data: data,
            success: function(data){
                if(data.length > 0){
                    $('#pagination-container').pagination({
                        dataSource: data,
                        pageSize: 9,
                        callback: function(data, pagination) {
                            var html = listProduct(data);
                            $('#product').html(html);
                        }
                    });
                    prods = data;
                }
                else{
                    $('#product').html('');
                    $('#pagination-container').hide();
                }

            }
        });
    });

</script>