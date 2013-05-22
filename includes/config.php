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

	$menu_active = 'Photostream';

	// Um ein Array hinten anzuhängen, muss $menu_add in $menu[] umbenennt und der "array_shift" entfernt werden.
	$menu_add = array(
		'name'	=> 'Freunde Finden',
		'link'	=> './user_overview.php'
	);
	array_unshift($menu, $menu_add);
	
	$menu_add = array(
		'name'	=> 'Photostream',
		'link'	=> './photostream.php'
	);
	array_unshift($menu, $menu_add);

}
