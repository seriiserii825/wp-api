<?php /**
 * Plugin Name: Капча
 * Description: Удаляет поле для сайта и добавляет капчу
 */

//add_filter('comment_form_default_fields', 'wfm_capcha');
add_filter( 'preprocess_comment', 'wfm_check_capcha' );
add_filter( 'comment_form_field_comment', 'wfm_capcha2');

function wfm_capcha($fields){
	unset($fields['url']);

    $fields['captcha'] = '<p>
        <label for="capcha">Капча<span class="required">*</span></label>
        <input type="checkbox" name="capcha" id="capcha"/>
    </p>';
    
    return $fields;
}

function wfm_check_capcha($comment_data){
	if(is_user_logged_in()){
		return $comment_data;
	}
	
    if(!isset($_POST['capcha'])){
        wp_die('<b>Вы не прошли проверку капчи</b>');
    }

    return $comment_data;
}

function wfm_capcha2($comment_field){
	if(is_user_logged_in()){
		return $comment_field;
	}
	
	$comment_field .= '<p>
        <label for="capcha">Капча<span class="required">*</span></label>
        <input type="checkbox" name="capcha" id="capcha"/>
    </p>';
	
	return $comment_field;
}

