@extends('layouts.category_layout')
@section('title')
Stylitics - Category page
@stop

@section('breadcrumbs')
@if($parent_id == 0)
<a href="{{asset('/')}}">{!! $name_cate !!}</a>
@else
<a href="{{asset('/category/'.$parent_id)}}">{!! $parent_name !!}</a>
<span class="divider">›</span>
{!! $name_cate !!}
@endif
@stop

@section('content_right')
<!--    <img src="{{asset('assets/image/aosomi.jpg')}}" style="max-width: 100%; max-height: 100%;margin-bottom: 25px;" /> -->
<div class="heading-2">
        <span class="title-arrow">
            <span class="title-text">{!! mb_strtoupper($name_cate) !!}</span>
        </span>
    <select id="sort_prod" class="form-control pull-right dd-sort" onchange="sortProduct(this);">
        <option value="">Sắp xếp theo</option>
        <option value="1">Tên: A đến Z</option>
        <option value="2">Tên: Z đến A</option>
        <option value="3">Giá: Cao nhất</option>
        <option value="4">Giá: Thấp nhất</option>
    </select>
</div>

<div id="product">
    @foreach($pro_cate as $pro)
    <div class="col-sm-4 col-md-4 product">
        <div class="p-img">
            <a href="{{asset('product/'.$pro->id)}}"><img src="{{asset('upload/images/'.$pro->image)}}"/></a>
            <a href="#" class="icon-cart"><i class="fa fa-shopping-bag fa-1-2"></i></a>
        </div>
        <div class="p-title">
            @if($pro->discount > 0)
            <div class="div-row">
                <span class="sale-label">SALE</span>
                <span class="price-new pull-right">{{number_format($pro->price - $pro->price*$pro->discount/100, 0, ',', '.')}} đ</span>
            </div>
            <div class="div-row">
                <span class="p-name pull-left">{{$pro->pro_name}}</span>
                <span class="price-old pull-right">{{number_format($pro->price, 0, ',', '.')}} đ</span>
            </div>
            @else
            <div class="div-row">
                <span class="p-name">{{$pro->pro_name}}</span>
                <span class="price-new pull-right">{{number_format($pro->price, 0, ',', '.')}} đ</span>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
<div id="pagination-container" class="col-sm-12 col-md-12" style="text-align: center"></div>
@stop

@section('javascript')
<script>
    var products = <?php echo json_encode($pro_cate);?>;
    $('#pagination-container').pagination({
        dataSource: products,
        pageSize: 9,
        callback: function(data, pagination) {
            var html = listProduct(data);
            $('#product').html(html);
        }
    });
    function listProduct(data) {
        var html = '';
        $.each(data, function(index, item){
            var url_pro = "{{asset('product')}}/" + item.id;
            var url_img = "{{asset('upload/images')}}/" + item.image;
            var pro_info = item.discount > 0 ? "<div class='div-row'><span class='sale-label'>SALE</span>" +
            "<span class='price-new pull-right'>"+accounting.formatNumber(item.price - item.price*item.discount/100, 0, '.', ',')+" đ</span></div>" +
            "<div class='div-row'><span class='p-name pull-left'>"+ item.pro_name +"</span>" +
            "<span class='price-old pull-right'>"+accounting.formatNumber(item.price, 0, '.', ',')+" đ</span></div>"
                : "<div class='div-row'><span class='p-name'>"+item.pro_name+"</span>" +
            "<span class='price-new pull-right'>"+accounting.formatNumber(item.price, 0, '.', ',')+" đ</span></div>";

            html += "<div class='col-sm-4 col-md-4 product'>" +
                "<div class='p-img'>" +
                "<a href='"+url_pro+"'><img src='"+ url_img +"'/></a>" +
                "<a href='#' id='"+ item.id +"' data-toggle='modal' data-target='#product_modal' onclick='quickViewClick(this);' class='icon-cart'><i class='fa fa-shopping-bag fa-1-2'></i></a></div>" +
                "<div class='p-title'>" + pro_info +
                "</div></div>";
        });
        return html;
    }
    function sortProduct(btn){
        if($(btn).val() != ''){
            if (prods == null)
                prods = <?php echo json_encode($pro_cate);?>;
            if($(btn).val() == '1')
                prods = prods.sort(function(a, b){
                    return a.pro_name - b.pro_name;
                });
            else if($(btn).val() == '2')
                prods = prods.sort(function(a, b){
                    return b.pro_name - a.pro_name;
                });
            else if($(btn).val() == '3')
                prods = prods.sort(function(a, b){
                    var x = a.price - a.price * a.discount/100;
                    var y = b.price - b.price * b.discount/100;
                    return y - x;
                });
            else
                prods = prods.sort(function(a, b){
                    var x = a.price - a.price * a.discount/100;
                    var y = b.price - b.price * b.discount/100;
                    return x - y;
                });

            $('#pagination-container').pagination({
                dataSource: prods,
                pageSize: 9,
                callback: function(data, pagination) {
                    var html = listProduct(data);
                    $('#product').html(html);
                }
            });
        }
    }
</script>
@stop