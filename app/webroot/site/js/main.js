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





function compareProduct(id, category) {
    var message;
    $.post('?mod=product&site=ajax_set_compare_product', {
        'id': id, 'category': category
    }).done(function (rt) {
        if (rt == '1') {
            message = "Thêm vào so sánh thành công !";
            updateCompareItem('add');
            addToCompareList(id);
        } else if (rt == '2') {
            message = "Sản phẩm đã được đưa vào so sánh !";
        } else if (rt == '3') {
            message = "Sản phẩm không cùng loại, không thể so sánh !";
        }
        MessageModal(message);
        return false;
    });
    return false;
}

function removeCompareProduct(id) {
    $.post('?mod=product&site=ajax_remove_compare_product', {
        'id': id
    }).done(function (rt) {
        updateCompareItem();
        $("#compare" + id).hide();
        return false;
    });
}

// Dua san pham so sanh vao danh sach
function addToCompareList(product_id) {
    $.post('?mod=product&site=ajax_load_compare_list', {
        'id': product_id
    }).done(function (rt) {
        $(".compare_product ul").append(rt);
        return false;
    });

}

function updateCompareItem(type) {
    var number = parseInt($("#compareItem span").html());
    if (type == 'add') {
        number = number + 1;
    } else {
        number = number - 1;
    }
    if (number < 0)
        number = 0;
    $("#compareItem span").html(number + " item");
    return false;
}

function likeProduct(id) {
    var message;
    $.post('?mod=product&site=ajax_like_product', {
        'id': id
    }).done(function (rt) {
        if (rt == '2') {
            message = 'Bạn đã thích sản phẩm này !';
        }
        if (rt == '1') {
            message = 'Bạn vừa thích một sản phẩm';
        }
        if (rt == '0') {
            message = 'Bạn chưa đăng nhập, không thể thích được sản phẩm.';
        }
        MessageModal(message);
        return false;
    });
}

function SetStarProduct(id, point) {
    var message;
    $.post('?mod=product&site=ajax_set_star_product', {
        'id': id, "point": point
    }).done(function (rt) {
        if (rt == '1') {
            message = 'Đánh giá thành công. Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi !';
        }
        if (rt == '0') {
            message = 'Bạn chưa đăng nhập, không thể đánh giá được sản phẩm.';
        }
        LoadStarProduct(id);
        MessageModal(message);
        return false;
    });
}

function LoadStarProduct(id) {
    $.post('?mod=product&site=ajax_load_star_products', {
        'id': id
    }).done(function (rt) {
        console.log(rt);
        if (rt != '0')
            $("#Star" + id).html(rt);
        return false;
    });

}

function MessageModal(message) {
    $('#MessageModal').modal('show');
    $('#MessageModal').on('shown.bs.modal', function () {
        $('#MessageModal').find('.modal-body p').html(message);
    });
}
