var widths = $(window).width();

$(document).ready(function () {



    if(widths <= 992){

        if ($('.prod-slider').length)
            $('.prod-slider').bxSlider({
                auto: false,
                slideWidth: 1200,
                maxSlides: 1,
                minSlides: 1,
                moveSlides: 1,
                pager: true
            });

    }else{
        if ($('.prod-slider').length)
            $('.prod-slider').bxSlider({
                auto: false,
                slideWidth: 1200,
                maxSlides: 3,
                minSlides: 3,
                moveSlides: 1,
                pager: true
            });
    }

    $(".menu ul li").each(function () {
        var bg = $(this).attr("color");
        $(this).css({"background": bg});
    });

    if ($('.bxslider').length)
        $('.bxslider').bxSlider({
            auto: true,
            slideWidth: 1200,
            maxSlides: 1,
            minSlides: 1,
            moveSlides: 1,
            pager: false
        });

    if ($('.sidebar_slider').length)
        $(".sidebar_slider").bxSlider({
            controls: false,
            auto: true,
        });

    if ($('.trade_slider').length)
        $(".trade_slider").bxSlider({
            pager: false,
            slideWidth: 1200,
            auto: true,
            maxSlides: 5,
            minSlides: 5,
            slideMargin: 20
        });


    $(".btn_tab_event > a").click(function () {
        var elm_click = $(this).attr('tab');
        $(".btn_tab_event > a").removeClass("active");
        $(this).addClass("active");


        $(".tab_cont").removeClass("block");
        $("#" + elm_click).addClass("block");

    });

});






function SetStarProduct(id, point) {
    var message;
    $.post('./?mc=product&site=set_star', {
        'id': id, "point": point
    }).done(function (rt) {

        if (rt == '1') {
            window.location.reload(true);
            // message = 'Đánh giá thành công. Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi !';
            // MessageModal(message);
            // setTimeout(() => {

            // },2000)
        }
        if (rt == '0') {
            message = 'Bạn chưa đăng nhập, không thể đánh giá được sản phẩm.';
            MessageModal(message);
            return;
        }
        // LoadStarProduct(id, point, rt.danhgia, rt.mark);
    });
}

function LoadStarProduct(id, point, danhgia, mark) {
    var append = '';
    for ( index = 1; index <=5 ; index++)
    {
        if(point - index >= 0)
            append += `<i class="fa fa-star checked" onclick="SetStarProduct(${id}, ${index});"></i>`;
        else
            append += `<i class="fa fa-star" onclick="SetStarProduct(${id}, ${index});"></i>`;
    }
    console.log(append);
    $("#Star" + id).html(append);
}

function MessageModal(message) {
    $('#MessageModal').modal('show');
    $('#MessageModal').on('shown.bs.modal', function () {
        $('#MessageModal').find('.modal-body p').html(message);
    });
}
