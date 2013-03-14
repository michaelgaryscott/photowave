<?php
error_reporting(0);
session_start();

require_once 'db_connection.php';

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
	),
	array(
		'name'	=> 'Photostream',
		'link'	=> './photostream.php'
	),
		array(
		'name'	=> 'Freunde Finden',
		'link'	=> './user_overview.php'
	),
);