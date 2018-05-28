<?php /**
 * Plugin Name: Первый плагин
 * Description: Описание первого плагина
 * Domain Path: domain/path
 */

/**
 * summary
 */
class WFMActivate
{
    /**
     * summary
     */
    public function __construct()
    {
        register_activation_hook( __FILE__, [$this, 'wfm_activate'] );
    }

    function wfm_activate(){
        $date = '['.date('d-m-Y H:i:s').']';
        error_log($date . ' Плагин активирован успешно!!!' . PHP_EOL, 3, __DIR__ . '/wmf-activation-logs.log');
    }
}

$wfm_activate = new WFMActivate;

register_deactivation_hook( __FILE__, 'wfm_deactivate' );

function wfm_deactivate(){
    $date = '['.date('d-m-Y H:i:s').']';
    error_log($date . ' Плагин деактивирован успешно!!!' . PHP_EOL, 3, __DIR__ . '/wmf-activation-logs.log');
}



