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
    if (!$posts) {
        return;
    }
    $post = $posts[0];
    $post_id = $post->ID;

    $output = '';
    switch ($return) {
        case 'image':
            $src = get_the_post_thumbnail_url($post_id, 'full');
            $output = $src;
            break;

        case 'url':
            $output = get_permalink($post_id);
            break;

        case 'cat':
            $terms = wp_get_post_terms($post_id, 'category', ['fields' => 'names']);
            $output = $terms[0];
            break;

        case 'data':
            $output = wp_date('F d, Y', strtotime($post->post_date));
            break;

        case 'hora':
            $output = wp_date('h:m', strtotime($post->post_date));
            break;

        case 'author':
            $author_id = $post->post_author;
            $output = get_the_author_meta('display_name', $author_id);
            break;

        case 'content':
            $output = apply_filters('the_content', $post->post_content);
            break;

        case 'excerpt':
            $output = $post->post_excerpt;
            break;

        default:
            $output = $post->post_title;
            break;
    }
    return $output;
}
add_shortcode('cf-post-data', 'cfpd_post_data');
