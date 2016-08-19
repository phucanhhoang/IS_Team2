<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>Stylitics | @yield('title')</title>
  <link rel="stylesheet" type="text/css"
        href="{{asset('assets/css/font-awesome/css/font-awesome.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pagination.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/AdminLTE.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/css.css')}}"/>

  @yield('head.css')
</head>
<body>
<!--header outside class container because header in full screens-->
@include('partials.header')

@yield('breadcrumb')

<div class="modal fade in" id="product_modal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 900px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">CHI TIẾT SẢN PHẨM</h4>
      </div>
      <div class="modal-body">
        <div class="detail-p">
          <div id="list_img" class="col-xs-12 col-sm-2 col-md-1 list"> </div>

          <div class="col-xs-12 col-sm-5 col-md-4 magnify">
            <div class="large"></div>
            <img id="product_img" class="small" src="" width="100%"/>
          </div>

          <div class="col-xs-12 col-sm-5 col-md-7 info">
            <div>
              <div class="div-1" id="product_title"></div>
              <form id="quick_cart_form" method="post" action="">
                <input type="hidden" name="product_id" id="product_id" value="id" />
                <div class="div-2">
                  <div>
                    <p class="title">Màu sắc</p>
                    <div class="mausac" id="pro_color"></div>
                  </div>
                  <div>
                    <p class="title">Kích cỡ</p>
                    <div class="kichco">
                      <div class="form-group" style="width: 160px">
                        <select class="form-control" id="size_id" name="size_id"></select>
                      </div>
                    </div>
                  </div>
                  <div style="margin-bottom: 0">
                    <p class="title">Số lượng: <input type="number" name="quantity" onkeyup="num_cart_validate(this);" min='1' max='20' value="1"/></p>
                    <div class="pull-right" style="width: 150px;">
                      <input id="btn_add" onclick="quickAddCart();" type="button" name="btnSubmit" value="THÊM VÀO GIỎ">
                      <label class="text-success" id="add_cart_msg" style="display: none"></label>
                    </div>
                  </div>
                </div>
              </form>

              <div class="fb-like" data-layout="standard"
                   data-action="like" data-size="small" data-send="true" data-show-faces="true" data-share="true"></div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="content">
  @yield('content')
</div>


<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=194334174266198";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

@include('partials.footer')
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!--Zoom product-->
<script type="text/javascript" src="{{asset('assets/js/prefixfree.js')}}"></script>
<!--Pagination-->
<script type="text/javascript" src="{{asset('assets/js/pagination.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/back-to-top.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/accounting.js')}}"></script>
<!--<script type="text/javascript" src="{{asset('assets/js/headroom.js')}}"></script>-->
<script type="text/javascript" src="{{asset('assets/js/app.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/site.js')}}"></script>
<script>
  $(function(){

  });

  var prods;

  function normalAddCart(){
    var data = $('#cart_form').serialize();
    addCart(data);
  }

  function quickAddCart(){
    var data = $('#quick_cart_form').serialize();
    addCart(data);
  }

  function addCart(data){
    if(!$('.chk_color').is(':checked') && $('#size_id').val() == ''){
      alert('Vui lòng chọn màu sắc và kích cỡ!');
      return true;
    }
    else if(!$('.chk_color').is(':checked')){
      alert('Vui lòng chọn màu sắc!');
      return true;
    }
    else if($('#size_id').val() == ''){
      alert('Vui lòng chọn kích cỡ!');
      return true;
    }

    $.ajax({
      type: 'POST',
      url: "{{asset('cart/add')}}",
      data: data,
      cache: false,
      success: function (data) {
        if(data == 'false'){
          alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
        }
        else{
          $('#shopping_cart').html('');
          var price;
          var price_int;
          var total_money = 0;
          var count_item = 0;
          $.each(data, function( rowid, cart ) {
            var url = "{{asset('upload/images')}}" + "/" + cart.options.image;
            var quantity = cart.qty;
            price_int = cart.price - cart.discount;
            total_money += cart.subtotal;
            price = accounting.formatNumber(price_int, 0, ".", ",");
            count_item += parseInt(cart.qty);
            $('#shopping_cart').append("<tr class='cart_id"+ cart.rowid +"'>" +
                "<td><a class='btn_del' onclick='cart_del(this);' id='"+ cart.rowid +"'" +
                "p-name='"+ cart.name +"' money='"+ cart.subtotal +"'>" +
                "<i class='fa fa-times-circle'></i></a></td>" +
                "<td width='20%'><img src='"+ url +"' style='width: 100%;height: auto'/></td>" +
                "<td>"+ cart.name +"<br>" +
                "<input type='number' class='qty_num qty_num"+cart.rowid+"' id='"+cart.rowid+"' " +
                "price='"+price_int+"' onkeyup='num_cart_validate(this);' " +
                "onchange='qty_onchange(this);' min='1' max='20' value='"+cart.qty+"' />" +
                " x "+ price +"đ</td>" +
                "<td>Size <label class='box-size'>"+ cart.options.size +"</label></td>" +
                "</tr>");
          });
          $('#cart_num').html(count_item);
          $('#cart_num').show();
          $('#total_money').val(total_money);
          total_money = accounting.formatNumber(total_money, 0, ".", ",");
          $('.cart_total').html(total_money);
          $('#cart').addClass('open');
          $('#add_cart_msg').html('Thêm thành công!');
          $('#add_cart_msg').show();
          $('#add_cart_msg').delay(2000).slideUp();
        }
      }
    });
  }

  function province_onchange(btn){
    var id = $(btn).val();
    if(id == '') {
      $('#district').html("<option value=''>Quận/Huyện</option>");
      return false;
    }
    $.ajax({
      type: 'POST',
      url: "{{url('get/district')}}",
      data: {province_id: id},
      success: function(data){
        $('#district').html("<option value=''>Quận/Huyện</option>");
        for(var i = 0; i<data.length; i++){
          $('#district').append("<option value='"+ data[i].id +"'>"+ data[i].name +"</option>");
        }
      }
    });
  }

  function quickViewClick(btn){
     var pro_id = $(btn).attr('id');
    $.ajax({
      type: "POST",
      url: "{{asset('product/quick-view')}}",
      data: {id: pro_id},
      success: function(data){
        $('#product_id').val(data['product'].id);
        $('#list_img').html('');
        var url = '';
        $.each(data['img_prods'], function(index, item){
          url = "{{asset('upload/images/details')}}/" + item.images;
          $('#list_img').append("<img src='"+ url +"' />");
        });
        url = "{{asset('upload/images')}}/" + data['product'].image;
        $('#product_img').attr('src', url);
        var price = data['product'].price;
        var price_new = data['product'].price - data['product'].price * data['product'].discount / 100;
        $('#product_title').html("<p class='title'>"+ data['product'].pro_name +"<span class='price-new'>"+ accounting.formatNumber(price_new, 0, '.', ',') +" đ</span>" +
            "<span class='price-old' style='margin-right: 10px'>"+ accounting.formatNumber(price, 0, '.', ',') +" đ</span></p><h6>Mã SP: "+ data['product'].pro_code +"</h6>");
        var stt=0;
        $('#pro_color').html('');
        $.each(data['img_colors'], function(index, item){
          stt++;
          $('#pro_color').append("<input type='radio' name='color_id' class='chk_color' " +
              "value='"+ item.color_id +"' id='ms-check"+ stt +"'/>" +
              "<label for='ms-check"+ stt +"' style='background-color: "+ item.color +"'></label>");
        });
        $('#size_id').html("<option value=''>Vui lòng chọn size</option>");
        $.each(data['sizes'], function(index, item){
          $('#size_id').append("<option value='"+ item.size_id +"'>"+ item.size +"</option>");
        });
      }
    });
  }
</script>
@yield('javascript')

</body>
</html>
