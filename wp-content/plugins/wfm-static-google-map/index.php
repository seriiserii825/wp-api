<?php /**
 * Plugin Name: Статическая Гугл Карта
 * Description: Гугл карта статическая, выводиться с помощью шорткода типа [map center="город, область" width="" height="" zoom=""]Орисание[/map]
 */

add_shortcode( 'map', 'wfm_satic_map' );

function wfm_satic_map($atts, $content){
    $atts = shortcode_atts( [
        'center' => 'Кишинев, Кишинёв',
        'width' => 600,
        'height' => 300,
        'zoom' => 13,
        'content' => !empty($content) ? $content : 'Описание карты'
    ], $atts);

    $atts['size'] = $atts['width'] . 'x' . $atts['height'];

    extract($atts);

    $map = '<h2>'.$content.'</h2>';

    $map .= '<img src="https://maps.googleapis.com/maps/api/staticmap?center='.$center.'&zoom=13&size='.$size.'&zoom='.$zoom.'&key=AIzaSyDbASjBErT7r7pqfSUhRQExumg3GQ9ZdGc" />';
//     $map .= '<img src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap
// &markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318
// &markers=color:red%7Clabel:C%7C40.718217,-73.998284
// &key=AIzaSyDbASjBErT7r7pqfSUhRQExumg3GQ9ZdGc" alt=""/>';

    return $map;
}
