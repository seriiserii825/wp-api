jQuery(document).ready(function($) {
    $('#wmf_ajax_btn').on('click', function() {
        var text = $.trim($('#wfm-text').val());

        // if(text == ''){
        //     alert('Введите текст рассылки');
        //     return;
        // }

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                data: text,
                action: 'wfm_subscriber_admin'
            },
            beforeSend: function(){
                $('.ajax-result').text('');

                $('.loader').css({
                    'display': 'inline-block'    
                });    
            },
           success: function(res){
                $('.loader').fadeOut(400, function(){
                    if(res === 'подходит'){
                        $('.ajax-result').css('color', 'green');
                    }else{
                        $('.ajax-result').css('color', 'red');
                    }
                    $('.ajax-result').text(res);
                });    
           },
           error: function(){
            alert('error');
           },

        });
        
    });
});