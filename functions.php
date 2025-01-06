<?php

/**
 * cfpd_debug
 *
 * @param  mixed $debug
 * @return string
 */
function cfpd_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

/**
 * cfpd_limit_string_by_word_count
 *
 * @param  string $string
 * @param  int $limit
 * @return string
 */
function cfpd_limit_string_by_word_count($string, $limit)
{
    $words = explode(' ', $string);
    $excerpt = implode(' ', array_slice($words, 0, $limit));
    $excerpt = preg_match("/[0-9.!?,;:]$/", $excerpt) ? $excerpt . '..' : $excerpt . '...';
    return $excerpt;
}
