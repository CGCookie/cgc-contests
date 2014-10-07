jQuery(window).load(function() {
    jQuery('.cgc-contest-sc-wrap').css('opacity', 1);
    jQuery('#cgc-contest-loading').remove();

});

jQuery(document).ready(function(){

    var item = jQuery('.cgc-contest-award-inner').parent(),
    	height = jQuery(item).height() - 30;

    jQuery('.cgc-contest-award-inner').height(height);

});