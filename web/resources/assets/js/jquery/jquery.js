// JavaScript Document

$(function () {
    //giúp menu luôn ra giữ màn hình (responsive)
    function setnav() {
        var nav_width = 0;
        var count = $('.nav-b>ul>li').length;

        for (var i = 0; i < count; i++)
            nav_width += $('.nav-b>ul>li').eq(i).width();
        nav_width += (parseInt($('.nav-b>ul>li').css('padding-left')) + parseFloat($('.nav-b>ul>li').css('padding-right'))) * count + 5;
        $('.nav-b>ul').css({"width": nav_width + "px"});
        $('.nav-b>ul').css({"left": "50%"});
        $('.nav-b>ul').css({"margin-left": -nav_width / 2 + "px"});
    }

    setnav();


    //Khi click chuột vào icon-bar thì menu sẽ hiện ra (khi độ rộng màn hình <480px)
    $('.nav-s div').click(function () {
        $('.nav-s ul').slideToggle(400);
    });


    //Tạo slide với responsive
    var slide_c = $('.slide-image a').length;
    for (var i = 0; i < slide_c; i++)
        $('.slide-bullet').prepend("<li></li>");
    $('.slide-image a:first-child img').addClass('focus');
    $('.slide-bullet li:first-child').addClass('focus');

    function setheightslide() {
        var slide_h = $('.slide-image a:first-child img').height();
        $('.slide').css({"height": slide_h + "px"});
        $('.slide .slide-bullet').css({"left": "50%"});
        var slide_bullet_w = $('.slide .slide-bullet').width();
        $('.slide .slide-bullet').css({"margin-left": -slide_bullet_w / 2 + "px"});
    }

    setheightslide();

    var eindex = 0;

    function setfocusimage() {
        if (eindex == slide_c - 1)
            eindex = -1;
        eindex++;
        $('.slide .slide-image .focus').stop().removeClass('focus').addClass('lastfocus');
        $('.slide .slide-image img').eq(eindex).stop().css("opacity", "0").addClass('focus').animate({opacity: 1}, 1500, function () {
            $('.slide .slide-image img').removeClass('lastfocus');
        });

        $('.slide .slide-bullet .focus').removeClass('focus');
        $('.slide .slide-bullet li').eq(eindex).addClass('focus');
    }

    var play;

    function startslide() {
        play = setInterval(function () {
            setfocusimage();
        }, 2500);
    }

    startslide();

    $('.slide .slide-image').hover(function () {
        clearInterval(play);
    }, function () {
        startslide();
    });

    //Tạo menu các mục (.elements) với responsive
    function setelements() {
        var policy_h = $('.elements .middle a').height() - $('.elements .left a').height() - parseFloat($('.elements .policy').css("margin-top"));
        var p_h = policy_h - parseFloat($('.elements .policy').css("padding")) * 2;
        var leftspan_h = $('.elements .left .policy p>span').height();
        var leftspan_w = $('.elements .left .policy p>span').width();
        var rightspan_h = $('.elements .right .policy p>span').height();
        var rightspan_w = $('.elements .right .policy p>span').width();

        $('.elements .policy').css({"height": policy_h + "px"});
        $('.elements .policy p').css({"height": p_h + "px"});
        $('.elements .left .policy p>span').css({"margin-top": -leftspan_h / 2 + "px"});
        $('.elements .left .policy p>span').css({"margin-left": -leftspan_w / 2 + "px"});
        $('.elements .right .policy p>span').css({"margin-top": -rightspan_h / 2 + "px"});
        $('.elements .right .policy p>span').css({"margin-left": -rightspan_w / 2 + "px"});
    }

    setelements();

    //Slide-detail
    var img_src = $('.detail-p  .list img').attr("src");
    $('.detail-p .large').css("background", "url(" + img_src + ")");

    $('.detail-p .list img').click(function () {
        var img_src = $(this).attr("src");
        $('.detail-p .small').attr("src", img_src);
        $('.detail-p .large').css("background", "url(" + img_src + ")");
    });


    var init_w = 0;
    var init_h = 0;
    $('.detail-p .detail').mousemove(function (e) {
        if (!init_w && !init_h) {
            var image = new Image();
            image.src = $('.detail-p .small').attr("src");
            init_w = image.width;
            init_h = image.height;
        }
        else {
            var offset_detail = $(this).offset();
            var mx = Math.round(e.pageX - offset_detail.left);
            var my = Math.round(e.pageY - offset_detail.top);

            if (mx < $(this).width() - 1 && my < $(this).height() - 1 && mx > 1 && my > 1) {
                $('.detail-p .large').fadeIn(100);
            }
            else {
                $('.detail-p .large').fadeOut(100);

            }
            if ($('.detail-p .large').is(":visible")) {
                var lx = mx / $(this).width() * init_w;
                var ly = my / $(this).height() * init_h;
                if (lx + $(this).width() > init_w)
                    lx = init_w - $(this).width();
                if (ly + $(this).height() > init_h)
                    ly = init_h - $(this).height();
                var bg_position = -lx + "px " + -ly + "px";

                $('.detail-p .large').css("background-position", bg_position);
                $('.detail-p .large').css("width", $('.detail-p .detail').width() + "px");
                $('.detail-p .large').css("height", $('.detail-p .detail').height() + "px");
            }

        }
    });


    //Giao diện thay đổi khi resize màn hình
    $(window).resize(function () {
        var width = $(window).innerWidth();
        if (width > 480)
            setnav();
        setheightslide();
        setelements();

    });


});









