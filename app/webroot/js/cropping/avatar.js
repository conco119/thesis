window.onresize = function(){
    var cw = $('#avatar_wrap_child').width();
    $('#avatar_wrap_child').css({
        'height': cw + 'px'
    });
};

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#avatar_image').cropper('replace', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

function check_avatar(){
	var cur_avt = $('#avatar_cur').attr('src');
	if(cur_avt.match(/fallback-avatar/g)){
		$('#del_avt_btn').attr('disabled','');
		console.log('wat');
	}
}

function load_cropper(){
	$('#avatar_image').cropper({
		aspectRatio : 1 / 1,
		autoCropArea : 0.94,
		preview : '.preview-lg,.preview-sm',
		crop : function(e) {
			$('input[name=avatar_x]').val(parseInt(e.x));
			$('input[name=avatar_y]').val(parseInt(e.y));
			$('input[name=avatar_width]').val(parseInt(e.width));
			$('input[name=avatar_height]').val(parseInt(e.height));
		}
	});
}

$(function(){
	$('#avatar-modal').on('show.bs.modal', function () {
	    // $('#avatar_change').hide();
	});

	$('.avatar-view').tooltip({
		'trigger':'hover',
		'title': 'Thay đổi avatar',
		'placement': 'bottom',
		'delay': { "show": 0, "hide": 50 },
	});

	$('.avatar-view').click(function(){
		$('#avatar-modal').modal('show');
		$('#avatar-modal').on('shown.bs.modal', function () {
			$('#avatar_change').fadeIn();
			check_avatar();
			var cw = $('#avatar_wrap_child').width();
		    $('#avatar_wrap_child').css({
		        'height': cw + 'px'
		    });

		    load_cropper();

		    var cur_avt = $('#avatar_cur').attr('src');
			$('#avatar_image').cropper('replace', cur_avt);

			$('.cropper-canvas').css({
				'width':'100%',
				'height':'100%'
			});
		});
	});

	$('#avatar-modal').on('hide.bs.modal', function () {
		$('#avatar_change').fadeOut(150);
	});

	$('#avatar-modal').on('hidden.bs.modal', function(){
		$('#avatarInput').val('');
    });
});
