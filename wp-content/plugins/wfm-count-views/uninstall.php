<?php 

if(!defined('WP_UNINSTALL_PLUGIN')){
    exit;
}

if(check_isset_field('wfm_views')){
    global $wpdb;
    $query = "ALTER TABLE $wpdb->posts DROP `wfm_views`";
    $wpdb->query($query);
}

