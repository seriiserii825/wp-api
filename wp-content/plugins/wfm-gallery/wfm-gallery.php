<?php /**
 * Plugin Name: Галерея
 * Description: Используйте шорткод типа [gallery ids="1,2,3"], где в атрибуте ids указывайте ID картинок.
 */

/**
 * удаляем системный шорткод
 */
remove_shortcode('gallery');


add_shortcode('gallery', 'wfm_gallery');

add_action('wp_enqueue_scripts', 'wfm_gallery_scripts');

add_action('admin_init', 'wfm_gallery_options');

register_deactivation_hook(__FILE__, 'wfm_delete_gallery_options');

function wfm_delete_gallery_options(){
	delete_option('wfm_gallery_options');
}

function wfm_gallery_options(){
    register_setting('general', 'wfm_gallery_options');

    //$id, $title, $callback, $page
    add_settings_section('wfm_gallery_section', 'Опции галлереи', '', 'general');

    //$id, $title, $callback, $page
    add_settings_field('wfm_gallery_title', 'Название галлереи', 'wfm_gallery_title_cb', 'general', 'wfm_gallery_section' );
    add_settings_field('wfm_gallery_text', 'Текст при отсутствии названия', 'wfm_gallery_text_cb', 'general', 'wfm_gallery_section');
}

function wfm_gallery_title_cb(){
    $options = get_option('wfm_gallery_options');

    ?>
        <input type="text" id="wfm_gallery_title" name="wfm_gallery_options[wfm_gallery_title]" class="regular-text" value="<?php echo $options['wfm_gallery_title'];?>">
    <?php
}

function wfm_gallery_text_cb(){
    $options = get_option('wfm_gallery_options');

    ?>
	<input type="text" id="wfm_gallery_text" name="wfm_gallery_options[wfm_gallery_text]" class="regular-text" value="<?php echo $options['wfm_gallery_text'];?>">
    <?php
}

function wfm_gallery_scripts(){
    wp_enqueue_script('lightbox-plus-jquery', plugins_url('lightbox-gallery/js/lightbox-plus-jquery.js', __FILE__), [], null, true);

    wp_enqueue_style('lightbox-css', plugins_url('lightbox-gallery/css/lightbox.min.css', __FILE__));
    wp_enqueue_style('lightbox-custom-css', plugins_url('lightbox-gallery/css/lightbox-custom.css', __FILE__));
}



function wfm_gallery($atts){

    $options = get_option('wfm_gallery_options');

    if(!isset($atts['ids']) || empty($atts['ids'])){

        return '<h2>' .$options['wfm_gallery_title']. '</h2><div class="wfm-gallery">' .$options['wfm_gallery_text']. '</div>';
    }

    $img_id = explode(',', $atts['ids']);

    $html = '<h2>' .$options['wfm_gallery_title']. '</h2><div class="wfm-gallery">';

        foreach ($img_id as $item){
            $img_data = get_posts([
                'include' => $item,
                'post_type' => 'attachment'
                ]);

            $img_desc = $img_data[0]->post_content;
            $img_caption = $img_data[0]->post_excerpt;
            $img_title = $img_data[0]->post_title;
            $img_thumb = wp_get_attachment_image_src($item);
            $img_full = wp_get_attachment_image_src($item, 'full');

            $html .= '<a href="'.$img_full[0].'" data-lightbox="gallery" data-title="'.$img_caption.'">
                        <img src="'.$img_thumb[0].'" alt="'.$img_title.'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'">
                     </a>';
        }

        wp_reset_postdata();

    $html .= '</div>';

    return $html;
}
