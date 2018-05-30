<?php
 /**
 * Plugin Name: Колличество просмотров для статей
 * Description: Плагин считает и выводит кол-во статей
 */
include __DIR__ . '/wfm-check.php';
register_activation_hook( __FILE__, 'wfm_create_field' );
add_filter( 'the_content', 'wfm_count_views' );
add_action('wp_head', 'wfm_add_view');
function wfm_create_field(){
    global $wpdb, $post;

    if(!wfm_check_field('wfm_reviews')){
        $query = "ALTER TABLE $wpdb->posts ADD wfm_reviews INT NOT NULL DEFAULT '0'";
        $wpdb->query($query);
    }
}
function wfm_count_views($content){
    if(is_page() || is_home()){
        return $content;
    }
    global $post;

    $views = $post->wfm_reviews;

    if(is_single()){
        $views += 1;
    }

    return $content . '<b>Колличество просмотров: </b>' . $views;
}
function wfm_add_view(){
    if(!is_single()){
        return;
    }

    global $post, $wpdb;
    $wfm_id = $post->ID;
    $views = $post->wfm_reviews + 1;

    $wpdb->update(
        $wpdb->posts,
        ['wfm_reviews' => $views],
        ['ID' => $wfm_id]
    );
}

