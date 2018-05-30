<?php /**
 * Plugin Name: Примеры работы хуков
 * Description: Несколько примеров работы хуков
 */

/*add_filter( 'the_title', 'wfm_title');

function wfm_title($title){
    if(is_admin()){
        return $title;
    }

    $title = mb_convert_case($title, MB_CASE_TITLE, "UTF-8");
    return $title;
}*/

//add_filter('the_title', 'ucwords');

/*add_filter('the_content', 'wfm_content');

function wfm_content($content){
    if(is_user_logged_in()){
        return $content;
    }elseif(is_page() || is_home()){
        return $content;        
    }else{
        return '<div><a href="' . home_url() . '/wp-login.php' . '">Авторизуйтесь для просмотра контента</a></div>';
    }
}*/

add_action('comment_post', 'wfm_comment');

function wfm_comment(){
    wp_mail( get_bloginfo( 'admin_email' ), 'Комментарий на сайте', 'Добавлен новый комментарий на сайте');
}