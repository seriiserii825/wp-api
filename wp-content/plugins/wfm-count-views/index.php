<?php /**
 * Plugin Name: Счетчик показа постов
 * Description: Плагин показывает счетчик посещения возле каждого поста
 */
include __DIR__ . '/functions.php';

register_activation_hook( __FILE__, 'wfm_create_field' );
add_filter( 'the_content', 'wfm_show_count');
add_action('wp_head', 'wfm_update_wfm_views');

/**
 * Добавляем поле wfm_views в таблице posts при активации плагина
 * @return [type] [description]
 */
function wfm_create_field(){

    if(!check_isset_field('wfm_views')){
        global $wpdb;
        $query = "ALTER TABLE $wpdb->posts ADD wfm_views INT NOT NULL DEFAULT '0'";
        $wpdb->query($query);
    }
}

/**
 * Увеличиваем счетсчик просмотра статьи для отдельного поста
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function wfm_show_count($content){
    if(is_page()){
        return $content;
    }

    global $post;
    $views = $post->wfm_views + 1;

    return $content . '<b>Кол-во просмотров: ' . $views . '</b>';
}

function wfm_update_wfm_views(){
    if(is_page()){
        return;
    }

    global $wpdb, $post;
    $id = $post->ID;
    $views = $post->wfm_views + 1;

    if($wpdb->update(
            $wpdb->posts,
            ['wfm_views' => $views],
            ['ID' => $id]
        )){
    }
}





