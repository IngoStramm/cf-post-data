<?php

function cfpd_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

function cfpd_excerpt_length($length)
{
    return 9;
}
add_filter('excerpt_length', 'cfpd_excerpt_length', 999);
