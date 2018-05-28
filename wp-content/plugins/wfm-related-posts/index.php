<?php /**
 * Plugin Name: Связанные записи
 * Description: Плагин выводит связанные записи поста по критерию категорий
 */

add_filter( 'the_content', 'wfm_related_posts' );
add_action( 'wp_enqueue_scripts', 'wfm_scripts' );

function wfm_related_posts($content){
    if(!is_single()){
        return $content;
    }

    $id = get_the_ID();
    $categories = get_the_category( $id );
    $category_id = [];

    foreach ($categories as $category) {
        $category_id[] = $category->term_id;
    }

    $related_posts = new WP_Query([
        'posts_per_page' => 5,
        'category__in' => $category_id,
        'orderby' => 'rand',
        'post__not_in' => $category_id
    ]);

    if($related_posts->have_posts()){
        $content .= '<div class="related-posts">';

            while($related_posts->have_posts()){
                $related_posts->the_post();

                $content .= '<div class="related-posts__item">';

                    if(has_post_thumbnail()){
                        $img = get_the_post_thumbnail( get_the_ID(), [100, 100], [
                            'alt' => get_the_title(), 
                            'title' => get_the_title(),
                            'class' => 'tooltip'
                        ] );
                    }else{
                        $img = '<img src="'.plugins_url( 'img/no-image.jpg', __FILE__ ).'" alt="'.get_the_title().'" title="'.get_the_title().'" class="tooltip"/>';
                    } 

                    $content .= '<a href="' .get_the_permalink(). '">' .$img.'</h2></a>';

                $content .= '</div>';
            }

        $content .= '</div>';

        return $content;
    }

    return $content;
}

function wfm_scripts(){
    wp_enqueue_style( 'wfm-tooltip', plugins_url('css/tooltipster.bundle.min.css', __FILE__) );
    wp_enqueue_style( 'wfm-style', plugins_url('css/style.css', __FILE__) );

    wp_enqueue_script( 'wfm-tooltip', plugins_url('js/tooltipster.bundle.min.js', __FILE__), ['jquery'], null, true );
    wp_enqueue_script( 'wfm-script', plugins_url('js/scripts.js', __FILE__), ['jquery'], null, true );
}