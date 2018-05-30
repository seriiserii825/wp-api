jQuery(document).ready(function($) {
    $('#wfm-form-subscribe').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: wfmajax.url,
            type: 'POST',
            data: {
                formData: formData,
                security: wfmajax.nonce,
                action: 'wfm_subscriber'
            },
            beforeSend: function(){
                $('.ajax-result').empty();
                $('.loader').fadeIn();
            }
        })
        .done(function(res) {
            $('.loader').fadeOut('slow', function() {
                 $('.ajax-result').text(res);

                 $('#wfm-form-subscribe').find('input:not(#wfm-submit)').val('');
            });
        })
        .fail(function() {
            alert("error");
        });
    });
});
