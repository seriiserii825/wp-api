<?php 
if( ! defined('WP_UNINSTALL_PLUGIN') ) exit;
include __DIR__ . '/wfm-check.php';
if(wfm_check_field('wfm_reviews')){

    global $wpdb;

    $query = "ALTER TABLE $wpdb->posts DROP wfm_reviews";

    $wpdb->query($query);

}