/**
 * Created by Phuc Anh Hoang on 7/12/2016.
 */

// JavaScript Document

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Tạo menu các mục (.elements) với responsive
    function setelements() {
        //set chieu cao cho policy
        policy_h = $('.elements .middle img').height() - $('.elements .left img').height() - 10;
        p_h = policy_h - 5 * 2;

        //Làm text ra giữa
        var leftspan_h = $('.elements .left .policy p>span').height();
        var leftspan_w = $('.elements .left .policy p>span').width();
        var rightspan_h = $('.elements .right .policy p>span').height();
        var rightspan_w = $('.elements .right .policy p>span').width();
        $('.elements .policy').css("height", policy_h + "px");
        $('.elements .policy p').css("height", p_h + "px");
        $('.elements .left .policy p>span').css({"margin-top": -leftspan_h / 2 + "px"});
        $('.elements .left .policy p>span').css({"margin-left": -leftspan_w / 2 + "px"});
        $('.elements .right .policy p>span').css({"margin-top": -rightspan_h / 2 + "px"});
        $('.elements .right .policy p>span').css({"margin-left": -rightspan_w / 2 + "px"});
    }

    setelements();

    //Slide-detail
    var img_src = $('.detail-p .list img').attr("src");
    $('.detail-p .large').css("background", "url(" + img_src + ")");

    $('.detail-p .list img').click(function () {
        var img_src = $(this).attr("src");
        $('.detail-p .small').attr("src", img_src);
        $('.detail-p .large').css("background", "url(" + img_src + ")");
    });

    //$('.chk_color').click(function(){
    //    var img_src = $(this).attr("url_prod_img");
    //    $('.detail-p .small').attr("src", img_src);
    //    $('.detail-p .large').css("background", "url(" + img_src + ")");
    //});


    //var init_w = 0;
    //var init_h = 0;
    //$('.detail-p .detail').mousemove(function (e) {
    //    if (!init_w && !init_h) {
    //        var image = new Image();
    //        image.src = $('.detail-p .small').attr("src");
    //        init_w = image.width;
    //        init_h = image.height;
    //    }
    //    else {
    //        var offset_detail = $(this).offset();
    //        var mx = Math.round(e.pageX - offset_detail.left);
    //        var my = Math.round(e.pageY - offset_detail.top);
    //
    //        if (mx < $(this).width() - 5 && my < $(this).height() - 5 && mx > 5 && my > 5) {
    //            $('.detail-p .large').fadeIn(100);
    //        }
    //        else {
    //            $('.detail-p .large').fadeOut(100);
    //
    //        }
    //        if ($('.detail-p .large').is(":visible")) {
    //            var lx = mx / $(this).width() * init_w;
    //            var ly = my / $(this).height() * init_h;
    //            if (lx + $(this).width() > init_w)
    //                lx = init_w - $(this).width();
    //            if (ly + $(this).height() > init_h)
    //                ly = init_h - $(this).height();
    //            var bg_position = -lx + "px " + -ly + "px";
    //
    //            $('.detail-p .large').css("background-position", bg_position);
    //            $('.detail-p .large').css("width", $('.detail-p .detail').width() + "px");
    //            $('.detail-p .large').css("height", $('.detail-p .detail').height() + "px");
    //        }
    //
    //    }
    //});

    //Thong tin san pham
    //var mausac_c = $('.mausac input').length;
    //for (var i = 1; i <= mausac_c; i++) {
    //    $('<label for="ms-check' + i + '"></label>').insertAfter('.mausac #ms-check' + i);
    //    $('.mausac label').eq(i - 1).css("background-color", $('.mausac input').eq(i - 1).attr("value"));
    //}



    //Giao diện thay đổi khi resize màn hình
    $(window).resize(function () {
        setelements();

    });

    var content_height = $(window).height() - 333;
    $('#content').css('min-height', content_height + 'px');
    $('#ft_id').show();

    jQuery.validator.addMethod("phoneno", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
    }, "Vui lòng nhập đúng số điện thoại");

});