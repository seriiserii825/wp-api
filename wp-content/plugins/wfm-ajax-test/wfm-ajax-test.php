<?php 
/*
 * Plugin Name: Ajax Test
 * Description: Тестовый плагин Ajax
*/
add_action( 'admin_menu', 'wfm_ajax_test' );
add_action('admin_init', 'wfm_ajax_admin_init');
add_action('wp_ajax_wfm_action', 'wfm_ajax_check');
function wfm_ajax_check(){
    //update_option( 'wfm_ajax_options', $_POST['formData']);
    //print_r($_POST['security']['nonce']);
    if(!wp_verify_nonce( $_POST['security']['nonce'], 'wfmAjax' )){
        wp_die('no');
    }
    if(preg_match('/^#[a-z0-9]+$/i', $_POST['formData'])){
        echo 'подходит';
        //update_option( 'wfm_ajax_options', $_POST['formData']);    
    }else{
        echo 'не подходит';
    }
    wp_die();
}
function wfm_ajax_admin_init(){
    register_setting( 'wfm_ajax_group', 'wfm_ajax_options' );
    add_settings_section( 'wfm_ajax_section', 'wfm_ajax_section_title', '', 'wfm_ajax_option_page' );
    add_settings_field( 'wfm_ajax_body_id', 'Цвет body', 'wfm_ajax_body_cb', 'wfm_ajax_option_page', 'wfm_ajax_section', [
        'label_for' => 'wfm_ajax_body_id'
    ] );
}
function wfm_ajax_body_cb(){
    $options = get_option( 'wfm_ajax_options', $default = false );
    ?>
    <input 
    type="text" 
    id="wfm_ajax_body_id" 
    name="wfm_ajax_options" 
    value="<?php echo isset($options['wfm_ajax_options']) ? esc_attr($options['wfm_ajax_options']) : '' ?>" 
    class="regular-text">
    <span class="loader">
        <img src="<?php echo plugins_url('img/loader.gif', __FILE__); ?>" alt="">
    </span>
    <span class="ajax-result"></span>
    <?php
}
function wfm_ajax_test(){
    $hook_suffix = add_options_page( 'ajax-test', 'ajax test', 'manage_options', 'ajax-test', 'wfm_ajax_test_cb' );
    add_action('admin_print_scripts-' . $hook_suffix, 'wfm_ajax_scripts');
    add_action('admin_print_styles-' . $hook_suffix, 'wfm_ajax_styles');
}
function wfm_ajax_styles(){
    wp_enqueue_style( 'wfm_ajax_style', plugins_url('css/wfm-ajax-style.css', __FILE__) );
}
function wfm_ajax_scripts(){
    wp_enqueue_script( 'wfm-ajax-scripts', plugins_url( 'wfm-ajax-scripts.js', __FILE__ ), ['jquery'], null, true );
    wp_localize_script( 'wfm-ajax-scripts', 'wfmAjax', ['nonce' => wp_create_nonce( 'wfmAjax' )] );
}
function wfm_ajax_test_cb(){
    ?>
    <div class="wrap">
        <h2>Ajax Test</h2>
        <form action="options.php" method="post" id="wfm-form">
           <?php 
           settings_fields( 'wfm_ajax_group' );
           do_settings_sections( 'wfm_ajax_option_page' );
           submit_button();
           ?> 
       </form>
   </div>
   <?php
}
