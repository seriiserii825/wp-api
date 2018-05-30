<?php /**
 * Plugin Name: Перавая опция
 * Description: Создаем первую опцию в раздел настройки
 */

add_action( 'admin_init', 'wfm_first_option' );

function wfm_first_option(){
    register_setting( 'general', 'wfm_first_option' );

    add_settings_field( 'wfm_first_option', 'Перавая опция', 'wfm_first_option_cb', 'general' );
}

function wfm_first_option_cb(){
    ?>
    <input type="text" id="wfm_first_option" name="wfm_first_option" class="regular-text" value="<?php echo get_option('wfm_first_option'); ?>">
    <?php
}


