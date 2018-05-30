jQuery(document).ready(function($){
    console.log(wfmOptionsObj);

    if(wfmOptionsObj.wfm_header_option) {
        $('.site-header').css({
            background: wfmOptionsObj.wfm_header_option
        });
    }

    if(wfmOptionsObj.wfm_body_option) {
        $('body').css({
            background: wfmOptionsObj.wfm_body_option
        });
    }
});
