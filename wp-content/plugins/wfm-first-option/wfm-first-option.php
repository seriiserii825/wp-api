<?php /**
 * Plugin Name: Перавая опция
 * Description: Создаем первую опцию в раздел настройки
 */

add_action( 'admin_init', 'wfm_theme_option' );
add_action( 'wp_enqueue_scripts', 'wfm_scripts_styles' );
register_uninstall_hook( __FILE__, 'wfm_theme_option_uninstall' );

function wfm_theme_option_uninstall(){
    delete_option( 'wfm_theme_option' );
}

function wfm_scripts_styles(){
    $wfm_theme_option = get_option('wfm_theme_option');

    wp_enqueue_script( 'wfm_first_option', plugins_url( 'wfm-first-option.js', __FILE__ ), ['jquery'], null, true );
    wp_localize_script( 'wfm_first_option', 'wfmObj', $wfm_theme_option );
}

function wfm_theme_option(){
    register_setting( 'general', 'wfm_theme_option' );

    add_settings_section( 'wfm_section_id', 'Опции темы', '', 'general' );

    add_settings_field( 'wfm_theme_option_body', 'опции body', 'wfm_theme_option_body_cb', 'general', 'wfm_section_id' );
    add_settings_field( 'wfm_theme_option_header', 'опции header', 'wfm_theme_option_header_cb', 'general', 'wfm_section_id' );
}

function wfm_theme_option_body_cb(){
    $options = get_option( 'wfm_theme_option' );
    ?>
    <input 
        type="text" 
        name="wfm_theme_option[wfm_theme_option_body]" 
        id="wfm_theme_option_body" 
        class="regular-text" 
        value="<?php echo $options['wfm_theme_option_body'] ?>"
    />
    <?php
}

function wfm_theme_option_header_cb(){
    $options = get_option( 'wfm_theme_option' );
    ?>
    <input 
        type="text" 
        name="wfm_theme_option[wfm_theme_option_header]" 
        id="wfm_theme_option_header" 
        class="regular-text" 
        value="<?php echo $options['wfm_theme_option_header'] ?>"
    />
    <?php
}

