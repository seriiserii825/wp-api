<?php
/**
* Plugin Name: Первый плагин
* Description: Описание первого плагина
*/
/*register_activation_hook( __FILE__, 'wfm_activate' );
function wfm_activate(){
wp_mail( get_bloginfo( 'admin_email' ), 'Активация плагина', 'Плагин успешно активирован');
}*/
/*register_activation_hook( __FILE__, 'wfm_activate' );
function wfm_activate(){
if( version_compare(PHP_VERSION, '7.4', '<') ){
exit('Вы используете версию PHP ниже 7.4');
}
}*/
/*class WFMActivate {
    function __construct(){
        register_activation_hook( __FILE__, [$this, 'wfm_activate'] );
    }
    function wfm_activate(){
        $date = date('Y-m-d H:i:s');
        error_log($date . ' Плагин успешно активирован', 3, __DIR__.'/wfm_errors_log.log');
    }
}

$wfm_activate = new WFMActivate;*/

register_activation_hook( __FILE__, 'wfm_activate' );
function wfm_activate(){
    $date = date('Y-m-d H:i:s');
    error_log($date . " Плагин успешно активирован".PHP_EOL, 3, __DIR__.'/wfm_errors_log.log');
}


register_deactivation_hook( __FILE__, 'wfm_deactivate' );
function wfm_deactivate(){
    $date = date('Y-m-d H:i:s');
    error_log($date . " Плагин успешно деактивирован".PHP_EOL, 3, __DIR__.'/wfm_errors_log.log');
}