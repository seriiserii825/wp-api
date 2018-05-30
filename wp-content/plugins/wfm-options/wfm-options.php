<?php

add_action('admin_init', 'wfm_theme_options');
add_action('wp_enqueue_scripts', 'wfm_theme_options_scripts');

register_deactivation_hook(__FILE__, 'wfm_theme_options_delete');

function wfm_theme_options_delete(){
	delete_option('wfm_theme_options');
}

function wfm_theme_options_scripts(){
	$options = get_option('wfm_theme_options');

	wp_enqueue_script('wfm-options', plugins_url('js/wfm-options.js', __FILE__), ['jquery'], null, true);

	wp_localize_script('wfm-options', 'wfmOptionsObj', $options);
}


function wfm_theme_options(){
	register_setting('general', 'wfm_theme_options');

	add_settings_section('wfm_section_id', 'Опции темы', 'wfm_theme_section_cb', 'general');

	add_settings_field('wfm_body_option', 'Цвет фона', 'wfm_theme_body_cb', 'general', 'wfm_section_id');
	add_settings_field('wfm_header_option', 'Цвет шапки', 'wfm_theme_header_cb', 'general', 'wfm_section_id');
}

function wfm_theme_section_cb(){
	echo '<p>Описание секции</p>';
}

function wfm_theme_body_cb(){
    $options = get_option('wfm_theme_options');

    ?>

    <input type="text" id="wfm_body_option" name="wfm_theme_options[wfm_body_option]" value="<?php echo $options['wfm_body_option'];?>" class="regular-text">

    <?php
}

function wfm_theme_header_cb(){
    $options = get_option('wfm_theme_options');

    ?>

    <input type="text" id="wfm_header_option" name="wfm_theme_options[wfm_header_option]" value="<?php echo $options['wfm_header_option'];?>" class="regular-text">

    <?php
}
