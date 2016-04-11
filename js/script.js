$(document).ready(function(){

	$('.saveForm .placeholder').each(function(){
		var that = this;
		

		$(this).find('input,textarea').focus(function(){
			$(that).addClass('focused');
		}).blur(function(){
			$(that).removeClass('error');
			if ($(this).val() == ''){
				$(that).removeClass('focused');
			}
		}).each(function(){
			if ($(this).val() != ''){
				$(that).addClass('focused');
			}
		});
	});

	$('.saveForm').submit(function(){
		var that,
			$inp,
			err = false;
		$(this).find('.placeholder.validate').each(function(){
			that = this;
			$inp = $(this).find('input,textarea');
			if ($inp.val() == ''){
				err = true;
				$(that).addClass('error');
				$inp.focus();
				return false;
			}
		});

		if (err){
			return false;
		}

	});

	$('#popup .undo').click(function(){
		var $popup = $('#popup');
		$popup.fadeOut();
		$popup.find('.save').attr('href','#');
		return false;
	});

	$('.but.delete').click(function(){
		var $popup = $('#popup');
		$popup.fadeIn();
		$popup.find('.save').attr('href',$(this).attr('href'));
		return false;
	});

});