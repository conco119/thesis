/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* New Sidebar Active */
function GetParamFromLink(name,link) {
	return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(link) || [null, ''])[1].replace(/\+/g, '%20')) || null;
}

function ApplyActive(target) {
	if ($("body").hasClass('nav-md')) {
		target.addClass('current-page').parent('ul').slideDown(350).parent().addClass('active');
	}
	else if ($("body").hasClass('nav-sm')) {
		target.addClass('current-page').parent('ul.child_menu').hide().parent().addClass('active-sm');
	}
}

$(function () {
	var chref = window.location.search;
	var cmod = GetParamFromLink('mod',chref);
	var csite = GetParamFromLink('site',chref);
	//var temp_help = chref.indexOf('&', chref.indexOf("&") + 1);
	//var url_core = window.location.search.substring(0,temp_help);
	//var url_tag = window.location.search.substring(temp_help);

	$('#sidebar-menu a').each(function () {
		var it = $(this);
		var lhref = $(this).attr('href');
		var lmod = GetParamFromLink('mod',lhref);
		var lsite = GetParamFromLink('site',lhref);
		if (lmod != null && lsite != null) {
			if (cmod == 'room' && (csite == 'statistics' || csite == 'detail')) {
				ApplyActive(it.parent('li#room_statistics_li'));
			}
			else if (cmod == 'room' && (csite == lsite || csite == 'setup' || csite == 'index' || csite == 'create')) {
				ApplyActive(it.parent('li#room_manager_li'));
			}
			else if (cmod == 'product' && csite == 'detail') {
				ApplyActive(it.parent('li#product_index_li'));
			}
			else if (cmod == lmod && (csite == lsite || csite == 'detail' || csite == 'history')) {
				ApplyActive(it.parent('li'));
			}
		}
		else if (cmod == null && csite == null) {
			ApplyActive(it.parent('li#home_li'));
		}
	});
});
/* End new sidebar active */

/*function getQueryVar(variable) {
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
		if(pair[0] == variable){return pair[1];}
	}
	return(false);
}*/

/** ******  left menu  *********************** **/
$(function () {
    //$('#sidebar-menu li ul').hide();
    //$('#sidebar-menu li').removeClass('active');

    $('#sidebar-menu ul.side-menu > li > a').on('click', function (e) {
		var itsli = $(this).parent();
		if(!e.ctrlKey && !e.altKey && !e.shiftKey) {
			//var link = $('a', this).attr('href');

			/*if (link) {
				window.location.href = link;
			} else {*/

			if ($(itsli).is('.active')) {
				$(itsli).removeClass('active');
				$(itsli).find('ul').slideUp(350);
			} else {
				$('#sidebar-menu li').removeClass('active');
				$('#sidebar-menu li ul').slideUp(350);

				$(itsli).addClass('active');
				$('ul', itsli).slideDown(350);
			}
		}
        //}
    });

    $('#menu_toggle').click(function () {
        if ($('body').hasClass('nav-md')) {
            $('body').removeClass('nav-md').addClass('nav-sm');
            $('.left_col').removeClass('scroll-view').removeAttr('style');
            $('.sidebar-footer').hide();

            if ($('#sidebar-menu li').hasClass('active')) {
                $('#sidebar-menu li.active').addClass('active-sm').removeClass('active');
				$('#sidebar-menu li.active-sm').removeClass('active');
				$('#sidebar-menu li.active-sm').find('ul').hide();
            }
        } else {
            $('body').removeClass('nav-sm').addClass('nav-md');
            $('.sidebar-footer').show();

            if ($('#sidebar-menu li').hasClass('active-sm')) {
                $('#sidebar-menu li.active-sm').addClass('active');
				$('#sidebar-menu li.active').removeClass('active-sm');
				$('#sidebar-menu li.active').find('ul').show();
            }
        }
    });
});

/* Old Sidebar Menu active class */
/*function old_sidebar() {
	var cmod = GetUrlParam('mod');
	var csite = GetUrlParam('site');
	var url = window.location.search;
	var temp_part = url.indexOf('&', url.indexOf("&") + 1);
	var url_core = window.location.search.substring(0,temp_part);
	var url_tag = window.location.search.substring(temp_part);
	//alert(arg_domain+url_core+url_tag);
	$('.nav-md #sidebar-menu a[href="?mod=' + cmod + '&site=' + csite + '"]').parent('li').addClass('current-page');
	$('.nav-md #sidebar-menu a').filter(function () {
		return this.href == arg_domain+url_core+url_tag;
	}).parent('li').addClass('current-page').parent('ul').slideDown(350).parent().addClass('active');
	$('.nav-sm #sidebar-menu a').filter(function () {
		return this.href == arg_domain+url_core+url_tag;
	}).parent('li').addClass('current-page').parent('ul').hide().parent().addClass('active-sm');
}*/

/** ******  /left menu  *********************** **/
/** ******  right_col height flexible  *********************** **/
$(".right_col").css("min-height", $(window).height());
$(window).resize(function () {
    $(".right_col").css("min-height", $(window).height());
});
/** ******  /right_col height flexible  *********************** **/



/** ******  tooltip  *********************** **/
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
/** ******  /tooltip  *********************** **/
/** ******  progressbar  *********************** **/
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar(); // bootstrap 3
}
/** ******  /progressbar  *********************** **/
/** ******  switchery  *********************** **/
if ($(".js-switch")[0]) {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            color: '#26B99A'
        });
    });
}
/** ******  /switcher  *********************** **/
/** ******  collapse panel  *********************** **/
// Close ibox function
$('.close-link').click(function () {
    var content = $(this).closest('div.x_panel');
    content.remove();
});

// Collapse ibox function
$('.collapse-link').click(function () {
    var x_panel = $(this).closest('div.x_panel');
    var button = $(this).find('i');
    var content = x_panel.find('div.x_content');
    content.slideToggle(200);
    (x_panel.hasClass('fixed_height_390') ? x_panel.toggleClass('').toggleClass('fixed_height_390') : '');
    (x_panel.hasClass('fixed_height_320') ? x_panel.toggleClass('').toggleClass('fixed_height_320') : '');
    button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    setTimeout(function () {
        x_panel.resize();
    }, 50);
});
/** ******  /collapse panel  *********************** **/
/** ******  iswitch  *********************** **/
if ($("input.flat")[0]) {
    $(document).ready(function () {
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
}
/** ******  /iswitch  *********************** **/
/** ******  star rating  *********************** **/
// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function ($, window) {
    var Starrr;

    Starrr = (function () {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function (e, value) {
            }
        };

        function Starrr($el, options) {
            var i, _, _ref,
                    _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'span', function (e) {
                return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function () {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'span', function (e) {
                return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function () {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function (rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function (rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }
            }
            if (!rating) {
                return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function () {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function () {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function () {
    return $(".starrr").starrr();
});

$(document).ready(function () {

    $('#stars').on('starrr:change', function (e, value) {
        $('#count').html(value);
    });


    $('#stars-existing').on('starrr:change', function (e, value) {
        $('#count-existing').html(value);
    });

});
/** ******  /star rating  *********************** **/
/** ******  table  *********************** **/
$('table input').on('ifChecked', function () {
    check_state = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    check_state = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

var check_state = '';
$('.bulk_action input').on('ifChecked', function () {
    check_state = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
    check_state = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
    check_state = 'check_all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
    check_state = 'uncheck_all';
    countChecked();
});

function countChecked() {
    if (check_state == 'check_all') {
        $(".bulk_action input[name='table_records']").iCheck('check');
    }
    if (check_state == 'uncheck_all') {
        $(".bulk_action input[name='table_records']").iCheck('uncheck');
    }
    var n = $(".bulk_action input[name='table_records']:checked").length;
    if (n > 0) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(n + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}
/** ******  /table  *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******    *********************** **/
/** ******  Accordion  *********************** **/

$(function () {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

/** ******  Accordion  *********************** **/

/** ******  scrollview  *********************** **/
$(document).ready(function () {

    $(".scroll-view").niceScroll({
        touchbehavior: true,
        cursorcolor: "rgba(42, 63, 84, 0.35)"
    });

});
/** ******  /scrollview  *********************** **/

/** ******  NProgress  *********************** **/
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
}
/** ******  NProgress  *********************** **/

$(document).ready(function () {
    $("#SelectAllRows").click(function () {
        $(".item_checked").prop('checked', $(this).prop('checked'));
    });

});

function setPrice(obj) {
    var value = $(obj).val();
    value = value.replace(/,/gi, "");
    value = parseInt(value);

    $.post('?mod=helps&site=ajax_get_number_format',
            {'value': value}
    ).done(function (data) {
        $(obj).val(data);
    });
}

function SetMoney(obj){
	var n = 0;
	var value = $(obj).val().replace(/,/g, "");
	if(value==null || value=='')
		value = 0;
	
	var re = '\\d(?=(\\d{' + (3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    var rt = parseFloat(value).toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
	if(rt==0)
		rt = '';
    
	$(obj).val(rt);
}


function ConvertMoney(money){
	var n = 0;
	if(money==null || money=='')
		money = 0;
	
	var re = '\\d(?=(\\d{' + (3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    var rt = parseFloat(money).toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
	if(rt==0)
		rt = '';
	return rt;
}

function HandleDelete(table) {
    var arr = [];
    $(".item_checked").each(function () {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            arr.push(value);
        }
    });
    if (arr.length < 1) {
        alert("Chọn 1 mục để xử lý");
        return false;
    }
    var str = arr.toString();
    $.post("?mod=helps&site=ajax_delete", {'table': table, 'id': str}).done(function () {
        location.reload();
    });

}

function HandleActive(table, type) {
    var arr = [];
    $(".item_checked").each(function () {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            arr.push(value);
        }
    });
    if (arr.length < 1) {
        alert("Chọn mục xử lý.")
        return false;
    }
    var str = arr.toString();
    $.post("?mod=helps&site=ajax_active", {'table': table, 'type': type, 'id': str})
            .done(function () {
                alert("Xử lý thành công.");
                location.reload();
            });
}

function activeItem(table, id) {
    $.post("?mod=helps&site=ajax_active_item", {'table': table, 'id': id}).done(function (data) {
        if (data == '0')
            alert('khong the cap nhat trang thai');
        if (data == '2') {
            $('#UpdateBarcode').modal('show');
            LoadBarcode(id);
        }
        else
            $("#stt" + id).html(data);
    });
}

function sortItem(table, id, sort) {
    if(sort<0)
    {
        alert("Vui lòng sắp xếp theo trình tự không âm.");
        sortItem(table, id, 1);
        return false;
    }
    $.post("?mod=helps&site=ajax_sort", {'table': table, 'id': id, 'sort': sort})
            .done(function () {
                location.reload();
            });
}

/**Chức năng xóa ajax
 * Đưa vào mod và id của item cần xóa
 * Xây dựng hàm ajax_delete trong class mod dể xử lý xóa
 */
function LoadDeleteItem(mod, id, site, target, reason) {
    PNotify.removeAll();
    $("#DeleteItem").attr("onclick", "DeleteItem('" + mod + "', " + id + ", '" + site + "', '" + target + "', '" + reason + "');");
}

function DeleteItem(mod, id, site, target, reason) {
    if (!site || site == '' || site == null || site == 'undefined')
        site = "ajax_delete";
    if (!target || target == '' || target == null || target == 'undefined')
        target = "mục";
    if (!reason || reason == '' || reason == null || reason == 'undefined')
        reason = "";
    $.post("?mod=" + mod + "&site=" + site, {'id': id})
    .done(function (data) {
        if (data == 0) {
            $('#DeleteForm').modal('hide');
            var notice = new PNotify({
                title: 'Xóa không thành công!',
                text: 'Không thể xóa ' + target + ' này ' + reason,
                type: 'error',
                mouse_reset: false,
                buttons: {
                    sticker: false,
                }
            });
            notice.get().click(function () {
                notice.remove();
            });
        } else {
            $('#DeleteForm').modal('hide');
            $('#field' + id).css('background', '#F7CDCE');
            $('#field' + id).fadeOut(800);
            var notice = new PNotify({
                title: 'Xóa thành công!',
                text: 'Xóa ' + target + ' thành công',
                type: 'success',
                mouse_reset: false,
                buttons: {
                    sticker: false,
                }
            });
            notice.get().click(function () {
                notice.remove();
            });
        }
    });
}





