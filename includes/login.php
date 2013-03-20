<?php
// LOGOUT
if (!empty($_POST['logout'])) {
	session_destroy();
	unset($_SESSION);

// LOGIN
// Ist die $_POST Variable submit nicht leer ???
// dann wurden Logindaten eingegeben, die müssen wir überprüfen !
} elseif (!empty($_POST["send"])) {

	// Die Werte die im Loginformular eingegeben wurden "escapen",
	// damit keine Hackangriffe über den Login erfolgen können !
	// Mysql_real_escape ist auf jedenfall dem Befehle addslashes()
	// vorzuziehen !!! Ohne sind mysql injections möglich !!!!
	$_username = mysql_real_escape_string($_POST["username"]);
	$_passwort = mysql_real_escape_string(md5($_POST["password"]));
	
	// Befehl für die MySQL Datenbank
	$_sql = '
		SELECT *
		FROM tblUser
		WHERE
			Mail = "'.$_username.'" AND
			Password = "'.$_passwort.'"
		LIMIT 1
	';

	// Prüfen, ob der User in der Datenbank existiert !
	$_res = mysql_query($_sql, $db_connection);
	$_anzahl = @mysql_num_rows($_res);
	
	// Die Anzahl der gefundenen Einträge überprüfen. Maximal
	// wird 1 Eintrag rausgefiltert (LIMIT 1). Wenn 0 Einträge
	// gefunden wurden, dann gibt es keinen Usereintrag, der
	// gültig ist. Keinen wo der Username und das Passwort stimmt
	// und user_geloescht auch gleich 0 ist !
	if ($_anzahl > 0) {
//		$login_out = 'Der Login war erfolgreich.<br />';

		// In der Session merken, dass der User eingeloggt ist !
		$_SESSION["login"] = 1;

		// Den Eintrag vom User in der Session speichern !
		$_SESSION["user"] = mysql_fetch_array($_res, MYSQL_ASSOC);

		// Das Einlogdatum in der Tabelle setzen !
		//$_sql = "UPDATE login_usernamen SET letzter_login=NOW()
		// 		 WHERE id=".$_SESSION["user"]["id"];
		//mysql_query($_sql);
		
		$temp = $_SESSION["user"];
		
		$_SESSION["userid"] = $temp["UserID"];
		$_SESSION["nachname"] = $temp["Name"];
		$_SESSION["vorname"] = $temp["Vorname"];
		$_SESSION["titel"] = $temp["Titel"];
		$_SESSION["mail"] = $temp["Mail"];
		$_SESSION["groupid"] = $temp["GroupID"];
		$_SESSION["geburtsdatum"] = $temp["Geburtsdatum"];
		$_SESSION["showname"] = $temp["Showname"];
		
	} else {
		$login_out = 'Die Logindaten sind nicht korrekt.<br />';
	}
	
}