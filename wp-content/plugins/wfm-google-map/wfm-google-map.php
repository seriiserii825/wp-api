<?php /**
 * Plugin Name: Google карты для сайта
 * Description: Для вывода карты используете шорткод вида [map center="город, область, страна" width="300" height="600" zoom="13"]Описание карты[/map];
 */

add_shortcode('map', 'wfm_map');

function wfm_map($atts, $description){
    $atts = shortcode_atts([
        'center' => 'Кишинев',
        'width' => 600,
        'height' => 300,
        'zoom' => 13,
        'description' => !empty($description) ? '<h3>' .$description. '</h3>' : '<h3>Описание для гугл карты</h3>'
    ], $atts);

    $size =  $atts['width'] . 'x' . $atts['height'];

    $center = $atts['center'];
    $center = str_replace(' ', '+', $center);
    $zoom = $atts['zoom'];
    $description = $atts['description'];

    $map = $description;
    $map .= '<img src="https://maps.googleapis.com/maps/api/staticmap?center='.$center.'&zoom='.$zoom.'&size='.$size.'&sensor=false&key=AIzaSyBh_Q-_MdaixZVROebhkmR9FqX8tZsbobU" alt="" />';
    /*$map .= '<div class="map"><img src="http://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&key=AIzaSyBh_Q-_MdaixZVROebhkmR9FqX8tZsbobU" alt="" /></div>';*/

    //var_dump($map);

    return $map;
}
