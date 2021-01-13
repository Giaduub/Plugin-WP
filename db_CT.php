<?php


function DBP_tb_create(){
global $wpdb;

$DBP_tb_name = $wpdb->prefix . "dbp_tb_ct";
$DBP_query = "CREATE TABLE $DBP_tb_name (
id int(6) NOT NULL AUTO_INCREMENT,
code varchar(30) DEFAULT '',
nom varchar(30) DEFAULT '',
hospitalises varchar(100) DEFAULT '',
gueris varchar(100) DEFAULT '',
deces varchar(100) DEFAULT '',
nouvellesHospitalisations varchar(100) DEFAULT '',
nouvellesReanimations varchar(100) DEFAULT '',
reanimation varchar(100) DEFAULT '',
PRIMARY KEY (id)
)";

require_once(ABSPATH ."wp-admin/includes/upgrade.php");
dbDelta($DBP_query);

}
