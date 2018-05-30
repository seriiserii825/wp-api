<?php /**
 * Plugin Name: Связанные записи
 * Description: Выводит связанные записи той же категории
 * Plugin URI: http://#
 * Author: Author
 * Author URI: http://#
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: text-domain
 * Domain Path: domain/path
 */

add_filter('the_content', 'wfm_related_posts');
add_action( 'wp_enqueue_scripts', 'wfm_register_scripts_styles' );

function wfm_register_scripts_styles(){
    wp_deregister_script( 'jquery' );
    wp_enqueue_script('wfm-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', [], null, true);
    wp_enqueue_script('wfm-drooltip.', plugins_url('js/drooltip.js', __FILE__), ['wfm-jquery'], null, true);
    wp_enqueue_script('wfm-scripts.', plugins_url('js/wfm-scripts.js', __FILE__), ['wfm-jquery'], null, true);

    wp_enqueue_style( 'wfm-drooltip', plugins_url('css/drooltip.css', __FILE__));
    wp_enqueue_style( 'wfm-style', plugins_url('css/wfm-style.css', __FILE__));
}

function wfm_related_posts($content){

    if(!is_single()){
        return $content;
    }

    $id = get_the_ID();
    $categories = get_the_category( $id );
    $cat_id = [];

    foreach ($categories as $category) {
        $cat_id[] = $category->cat_ID;
    }

    $related_posts = new WP_Query([
        'posts_per_page' => 5,
        'category__in' => $cat_id,
        'orderby' => 'rand',
        'post__not_in' => [$id]
    ]);

    if($related_posts->have_posts()){
        $content .= '<div class="related_posts"><h3>Здесь вы можете посмотреть связанные записи</h3>';
        while($related_posts->have_posts()){
            $related_posts->the_post();

            if(has_post_thumbnail()){
                $img = get_the_post_thumbnail( get_the_ID(), [100, 100], ['title'=>get_the_title(), 'alt'=>get_the_title(), 'class' => 'myTooltip'] );
            }else{
                $img = '<img class="myTooltip" src="' .plugins_url('images/no_img.jpg', __FILE__). '" alt="'.get_the_title().'" title="'.get_the_title().'" width="100" height="100" />';
            }

            $content .= '<a href="' .get_the_permalink(). '">' .$img. '</a>';
        }
        $content .= '</div>';

        wp_reset_query();
    }

    return $content; 
}



