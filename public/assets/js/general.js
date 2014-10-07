jQuery(window).load(function() {
    jQuery('.cgc-contest-sc-wrap').css('opacity', 1);
    jQuery('#cgc-contest-loading').remove();

    var item = jQuery('.cgc-contest-award-inner').parent(),
    	height = jQuery(item).height();

    jQuery('.cgc-contest-award-inner').height(height);

});