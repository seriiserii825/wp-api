<?php /**
 * Plugin Name: Динамическая гугл карта
 * Description: Используюйте шорткод типа [map coords1="" coords2="" zoom=""] для вставки карты
 */

//AIzaSyDktwZTymwmXXBdaBsGrN-qz3TYpI5IHbU

global $wfm_atts;

add_shortcode( 'map', 'wfm_map' );

function wfm_map($atts){
    global $wfm_atts;

    $atts = shortcode_atts( [
        'coords1' => 50,
        'coords2' => 30,
        'zoom' => 8,
    ], $atts);

    extract($atts);

    $wfm_atts = [
        'coords1' => $coords1,
        'coords2' => $coords2,
        'zoom' => $zoom,
    ];

    add_action( 'wp_footer', 'wfm_scripts');

    return '<div id="map"></div>';
}

function wfm_scripts(){
    global $wfm_atts;

    wp_enqueue_style( 'wfm-map-style', plugins_url('style.css', __FILE__));
    wp_enqueue_script( 'wfm-map-script', plugins_url( 'script.js', __FILE__ ));
    wp_enqueue_script( 'wfm-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDktwZTymwmXXBdaBsGrN-qz3TYpI5IHbU&callback=initMap');

    wp_localize_script('wfm-map-script', 'wfmObj', $wfm_atts);
}

