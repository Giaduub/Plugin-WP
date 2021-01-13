<?php
/*
Plugin Name: Covid Tracker
Plugin URI: LIEN VERS LE PLUGIN
Description: DESCRIPTION DU PLUGIN
Version: 1.0
Author: Gianni Dubief
Author URI: LIEN VERS VOTRE PAGE D’ACCUEIL
License: GPLv2
*/

if(!defined('ABSPATH')){
define('ABSPATH', dirname(__FILE__) . '/');
}
include_once("db_CT.php");
register_activation_hook(__FILE__,"DBP_tb_create");

include_once("dataAdd.php");
register_activation_hook(__FILE__,"addDB");

add_shortcode('CoviT', 'CT');

function CT(){
echo "<p id='toto'>coucou</p>";
wp_enqueue_script('covit', plugin_dir_url(__FILE__) . 'covit.js');
wp_enqueue_style('covit', plugin_dir_url(__FILE__) . 'covit.css');
}