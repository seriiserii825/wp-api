jQuery(document).ready(function($) {
    $('#wfm-form').submit(function(event) {
       $.ajax({
           url: ajaxurl,
           type: "POST",
           data: {
            formData: $('#wfm_ajax_body_id').val(),
            security: wfmAjax,
            action: 'wfm_action'
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
       return false;
   });
});