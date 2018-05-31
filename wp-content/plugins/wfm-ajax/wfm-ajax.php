<?php /**
 * Plugin Name: Ajax
 * Description: Первый плагин ajax
 */

add_action( 'admin_menu', 'wfm_admin_menu' );
add_action( 'admin_init', 'wfm_admin_settings' );

function wfm_admin_settings(){
    register_setting( 'wfm_theme_options_grop', 'wfm_theme_option_name' );

    add_settings_section( 'wfm_theme_options_section', 'Секция опций', '', 'wfm-theme-options-page' );

    add_settings_field( 'wfm_theme_option_bg_id', 'Цвет body', 'wfm_theme_option_bg_cb', 'wfm-theme-options-page', 'wfm_theme_options_section', ['label_for' => 'wfm_theme_option_bg_id'] );
}

function wfm_theme_option_bg_cb(){
    $option = get_option( 'wfm_theme_option_name' );
    ?>
        <input type="text" name="wfm_theme_option_name" id="wfm_theme_option_bg_id" value="<?php echo $option; ?>" class="regular-text">
    <?php
} 

function wfm_admin_menu(){
    $suffix_hook = add_options_page( 'menu_options', 'Опции ajax', 'manage_options', 'wfm-theme-options-page', 'wmf_options_cb' );

    add_action( 'admin_print_scripts-' . $suffix_hook, 'wfm_admin_scripts' );
}

function wfm_admin_scripts(){
    wp_enqueue_script( 'wfm_ajax_admin_scripts', plugins_url( 'wfm-ajax-scripts.js', __FILE__ ), ['jquery'], null, true );
}

function wmf_options_cb(){
    ?>
        <div class="wrap">
            <h2>Опции меню</h2>
            <form action="options.php" method="post">
                <?php settings_fields( 'wfm_theme_options_grop' ); ?>
                <?php do_settings_sections( 'wfm-theme-options-page' ); ?>

                <?php submit_button(); ?>    
            </form>
        </div>
    <?php
}

