<?php 

function check_isset_field($field_name){
    global $wpdb;

    $fields = $wpdb->get_results('SHOW fields FROM ' . $wpdb->posts, ARRAY_A);

    foreach ($fields as $field) {
        if($field['Field'] === $field_name){
            return true;
        }
    }    

    return false;
}


