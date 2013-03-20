<?php
error_reporting(0);
session_start();

require_once 'db_connection.php';
require_once 'login.php';

$header = array();
$title = '';

$menu_active = 'Home';
$menu = array(
	array(
		'name'	=> 'Home',
		'link'	=> './index.php'
	),
	array(
		'name'	=> 'About',
		'link'	=> './about.php'
	),
	array(
		'name'	=> 'Contacts',
		'link'	=> './contact.php'
	),
	array(
		'name'	=> 'Impressum',
		'link'	=> './impressum.php'
	)
);

if(isset($_SESSION["userid"])) {
	$menu[] = array(
		'name'	=> 'Photostream',
		'link'	=> './photostream.php'
	);
	$menu[] = array(
		'name'	=> 'Freunde Finden',
		'link'	=> './user_overview.php'
	);
}
