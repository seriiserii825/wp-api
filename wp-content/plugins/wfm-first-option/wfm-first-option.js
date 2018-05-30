jQuery(document).ready(function($) {
    if(wfmObj.wfm_theme_option_body){
        $('body').css('background', wfmObj.wfm_theme_option_body);
    }

    if(wfmObj.wfm_theme_option_header){
        $('body').css('color', wfmObj.wfm_theme_option_header);
    }
});