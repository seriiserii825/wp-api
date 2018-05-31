jQuery(document).ready(function($) {

    $('#wfm_ajax_form').on('submit', function(){

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                data: $('#wfm_theme_option_bg_id').val(),
                action: 'wfm_ajax_url'
            },
        })
        .done(function(res) {
            alert(res);
        })
        .fail(function(res) {
            alert("error");
        })

        return false;
    });

    
});