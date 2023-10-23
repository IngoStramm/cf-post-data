<?php

/**
 * Plugin Name: Converte Fácil Post Data
 * Plugin URI: https://agencialaf.com
 * Description: Descrição do Converte Fácil Post Data.
 * Version: 0.0.4
 * Author: Ingo Stramm
 * Text Domain: cf-post-data
 * License: GPLv2
 */

defined('ABSPATH') or die('No script kiddies please!');

define('CFPD_DIR', plugin_dir_path(__FILE__));
define('CFPD_URL', plugin_dir_url(__FILE__));

function cfpd_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

require_once 'tgm/tgm.php';
require_once 'classes/classes.php';
require_once 'scripts.php';
require_once 'shortcode.php';
require_once 'settings.php';

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/cf-post-data/master/info.json',
    __FILE__,
    'cfpd'
);
