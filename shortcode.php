<?php

function cfpd_post_data($atts)
{
    $atts = shortcode_atts(array(
        'offset' => 0,
        'type' => 'post',
        'return' => 'post_title',
    ), $atts);

    $offset = intval($atts['offset']);
    $return = $atts['return'];
    $post_type = $atts['type'];

    $args = [
        'numberposts'       => 1,
        'offset'            => $offset,
        'order'             => 'DESC',
        'orderby'           => 'date',
        'post_type'         => $post_type,
        'post_status'       => ['publish']
    ];

    $posts = get_posts($args);
    $post = $posts[0];
    $post_id = $post->ID;

    switch ($return) {
        case 'image':
            $src = get_the_post_thumbnail_url($post_id, 'full');
            // return '<img src=' . $src . ' class="cf-post-data-image" />';
            return $src;
            break;

        case 'url':
            return get_permalink($post_id);
            break;

        case 'cat':
            $terms = wp_get_post_terms($post_id, 'category', ['fields' => 'names']);
            return $terms[0];
            break;

        case 'data':
            return wp_date('F d, Y', strtotime($post->post_date));
            break;

        case 'hora':
            return wp_date('h:m', strtotime($post->post_date));
            break;

        default:
            return $post->post_title;
            break;
    }
}
add_shortcode('cf-post-data', 'cfpd_post_data');
