<?php /**
 * Plugin Name: Картча
 * Description: Плагин добавляет капчу для формы комментариев
 */

add_filter( 'comment_form_default_fields', 'wfm_delete_site');
add_filter('preprocess_comment', 'wfm_check_captcha');

function wfm_delete_site($data){
    //var_dump($data);

    unset($data['url']);

    $data['captcha'] = '<p class="comment-form-author">
        <label for="captcha">Каптча <span class="required">*</span></label>
        <input id="captcha" name="captcha" type="checkbox" required="required" />
    </p>';

    return $data;
}

function wfm_check_captcha($data){
    if(is_user_logged_in()){
        return $data;
    }
    
    if(isset($_POST['captcha'])){
        return $data;
    }

    wp_die('Вы не прошли контроль на человечность');
}

