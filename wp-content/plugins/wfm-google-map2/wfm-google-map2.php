<?php /**
 * Plugin Name: Google карты для сайта v.2
 * Description: Пример шорткода: [map coords1="50" coords2="30" zoom="17"]
 */
$wfm_array_map = [];

add_shortcode('map', 'wfm_map_2');//создаем шорткод для карты

/**
 * @param $atts параметры шорткода
 * @return string возвращает строку, которая будет вставлена в html файл
 */
function wfm_map_2($atts){
    global $wfm_array_map;

    //передаем параметры по-умолчанию в шорткод
    $atts = shortcode_atts([
        'cords1' => 50,
        'cords2' => 30,
        'zoom' => 8,
    ], $atts);

    //добавляем параметры из шорткода в массив, который будет передаваться в javascript файл
    $wfm_array_map = [
        'cords1' => $atts['cords1'],
        'cords2' => $atts['cords2'],
        'zoom' => $atts['zoom'],
    ];

    //подключаем файл со скриптами
    add_action('wp_footer', 'wfm_style_scripts');

    //добавляем див с картой в html файл
    return '<div id="map-canvas" style="width: 600px; height: 300px;"></div>';
}

/**
 * подключаем скрипты
 */
function wfm_style_scripts(){
    global $wfm_array_map;

    wp_enqueue_script('wfm-google-map-2', plugins_url('wfm-google-map2.js', __FILE__), [], null, true);
    wp_enqueue_script('wfm_google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCJvzU1vRZLRVmGTjV77ArOnxwJfGSnxQ4&callback=initMap', [], null, true);

    //передаем данные из шорткода в javascript файл с помощью объекта
    wp_localize_script('wfm-google-map-2', 'wfmObj', $wfm_array_map);
}

















