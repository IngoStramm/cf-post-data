<?php

add_action('wp_enqueue_scripts', 'cfpd_frontend_scripts');

function cfpd_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    if (empty($min)) :
        wp_enqueue_script('cf-post-data-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    wp_register_script('cf-post-data-script', CFPD_URL . 'assets/js/cf-post-data' . $min . '.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('cf-post-data-script');

    wp_localize_script('cf-post-data-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_style('cf-post-data-style', CFPD_URL . 'assets/css/cf-post-data.css', array(), false, 'all');
}
