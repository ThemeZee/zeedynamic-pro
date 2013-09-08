/*! jQuery theme-options.js
  Add Theme Options Scripts for Colorpicker, Fontpicker and Image Upload
  Author: Thomas W (themezee.com)
*/

jQuery(document).ready(function($){
    
	/* Add colorpicker */ 
	$('.zee-colorpicker-field').wpColorPicker();
	
	
	/* Add fontpicker */
	$(".zee-fontpicker").change(function () {
		var css = "";
		var id = $(this).attr('id');
		css = $("#" + id + " option:selected").text();
		$("#" + id + "_preview").css({ 'font-family': css });
	})

	
	/* Add image upload functionality */
	$('.zee-upload-image-button').click(function() {
        inputID = $(this).prev().attr('id');
		formfield = $('#'+inputID).attr('name');
        tbframe_interval = setInterval(function() {$('#TB_iframeContent').contents().find('.savesend .button').val(zee_localizing_upload_js.use_this_image);}, 1000);
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		
		window.send_to_editor = function(html) {
			imgurl = $('img',html).attr('src');
			$('#'+inputID).val(imgurl);
			$('#'+inputID+'img').attr("src",imgurl);
			tb_remove();
		}
        return false;
    });
});