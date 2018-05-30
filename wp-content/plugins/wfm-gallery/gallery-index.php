<?php /**
 * Plugin Name: Галлерея
 * Description: Добавляйте картинки в галлерею при помощи стандартного шорткода 
 */

add_shortcode( 'gallery', 'wfm_gallery' );
add_action( 'admin_init', 'wfm_gallery_options' );
register_uninstall_hook( __FILE__, 'wfm_gallery_options_uninstall' );

function wfm_gallery_options_uninstall(){
    delete_option( 'wfm_gallery_options' );
}

function wfm_gallery_options(){
    register_setting( 'general', 'wfm_gallery_options' );

    add_settings_section( 'wfm_gallery_section_id', 'Опции галереи', '', 'general' );

    add_settings_field( 'wfm_gallery_title', 'Название галереи', 'wfm_gallery_options_title_cb', 'general', 'wfm_gallery_section_id' );
    add_settings_field( 'wfm_gallery_text', 'Текст при отсутствии картинок', 'wfm_gallery_options_text_cb', 'general', 'wfm_gallery_section_id' );
}

function wfm_gallery_options_title_cb(){
    $options = get_option( 'wfm_gallery_options' );
    ?>
        <input type="text" name="wfm_gallery_options[wfm_gallery_title]" id="wfm_gallery_title" class="regular-text" value="<?php echo $options['wfm_gallery_title']; ?>">
    <?php
}

function wfm_gallery_options_text_cb(){
    $options = get_option( 'wfm_gallery_options' );
    ?>
        <input type="text" name="wfm_gallery_options[wfm_gallery_text]" id="wfm_gallery_text" class="regular-text" value="<?php echo $options['wfm_gallery_text']; ?>">
    <?php
}

function wfm_gallery($atts){
    $gallery_options = get_option('wfm_gallery_options');

    $html = '<h2>'.$gallery_options['wfm_gallery_title'].'</h2> <div id="gallery" class="gallery">';


    if(!empty($atts['ids'])){
        $id_arr = explode(',', $atts['ids']);    

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

    }else{
        $html .= '<h3>'.$gallery_options['wfm_gallery_text'].'</h3>';
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
