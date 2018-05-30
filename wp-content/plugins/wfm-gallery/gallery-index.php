<?php /**
 * Plugin Name: Галлерея
 * Description: Добавляйте картинки в галлерею при помощи стандартного шорткода 
 */

add_shortcode( 'gallery', 'wfm_gallery' );

function wfm_gallery($atts){
    $id_arr = explode(',', $atts['ids']);

    $html = '<div id="gallery" class="gallery">';

    foreach ($id_arr as $id) {
        $img_data = get_post($id, ARRAY_A);

        $title = $img_data['post_title'];
        $desc = $img_data['post_content'];

        $img_thumb = wp_get_attachment_image_src( $id );
        $img_full = wp_get_attachment_image_src($id, 'full');

        $html .= '<a href="'.$img_full[0].'" data-lightbox="gallery" data-title="'.$title.'">
            <img src="'.$img_thumb[0].'" width="'.$img_thumb[1].'" height="'.$img_thumb[1].'" alt="" />
        </a>';
    }

    $html .= '</div>';

    add_action( 'wp_footer', 'wfm_gallery_scripts');

    return $html;
}

function wfm_gallery_scripts(){
    wp_enqueue_style( 'wfm-gallery', plugins_url( 'css/lightbox.min.css', __FILE__ ));
    wp_enqueue_style( 'wfm-gallery-custom', plugins_url( 'css/style.css', __FILE__ ));

    wp_enqueue_script( 'wfm-gallery', plugins_url('js/lightbox.min.js', __FILE__), ['jquery']);
    wp_enqueue_script( 'wfm-gallery-custom', plugins_url('js/custom.js', __FILE__), ['jquery']);
}
