<?php
$_db_host		= 'localhost';
$_db_datenbank	= 'photowave_prod';
$_db_username	= 'photowave_prod';
$_db_passwort	= 'Bue3vV-phYa!8twT4pOPfBWwW2';

// SESSION_START();

// Datenbankverbindung herstellen
$db_connection = mysql_connect($_db_host, $_db_username, $_db_passwort);

// Hat die Verbindung geklappt ?
if (!$db_connection) {
	die('Keine Datenbankverbindung möglich: ' . mysql_error());
}

// Verbindung zur richtigen Datenbank herstellen
$db = mysql_select_db($_db_datenbank, $db_connection);

if (!$db) {
	echo 'Kann die Datenbank nicht benutzen: ' . mysql_error();
	mysql_close($db_connection);	// Datenbank schliessen
	exit;							// Programm beenden !
}
?>