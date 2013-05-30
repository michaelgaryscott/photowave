<?php
include 'includes/config.php';
$title = 'Benutzer editieren';
include 'includes/header-include.php';
###############################
## Zugriff nur für Hobbyclowns
###############################
if($_SESSION["groupid"] == 1)
{
	if(!isset($_POST["change"]))
	{
		#########################################################
		## Direkt von Benutzerverwaltung (keine Daten geändert)
		#########################################################
		// Post variabel (UserID) empfangen
		$id = $_POST["userid"];
		
		/*
		// SQL abfrage
		$db = mysql_connect('localhost', 'photowave_prod', 'Bue3vV-phYa!8twT4pOPfBWwW2') or die('Fehler beim Verbinden zum MySQL-Server');
		*/
		
		$sql = 'SELECT u.UserID, u.Name, u.Vorname, u.Titel, u.Mail, u.Password, u.GroupID, u.Geburtsdatum, u.Showname
				FROM tblUser AS u
				WHERE UserID = "'.$id.'"';
		/*
		mysql_select_db('photowave_prod', $db) or die ("Datenbank kann nicht ausgewählt werden");
								
									or die('Fehler bei der Datenbankabfrage');
		*/
		$ergebnis = mysql_query($sql)
		or die('Fehler bei der Datenbankabfrage');
		
		
		while ($zeile = mysql_fetch_array($ergebnis)) {
							$userid = $zeile['UserID'];
							$nachname = $zeile['Name'];
							$vorname = $zeile['Vorname'];
							$titel = $zeile['Titel'];
							$mail = $zeile['Mail'];
							$pass = $zeile['Password'];
							$groupid = $zeile['GroupID'];
							$geburtsdatum = $zeile['Geburtsdatum'];
							$showname = $zeile['Showname'];
		}
		
//								mysql_close($db);
								
		######################################
		## Ausgabe und abfüllen der Felder
		######################################
		
		if ($nachname = straub)
		{
			Delete $user;
		}


		if(!empty($vorname))
			$vorname_return = ' value="'.$vorname.'"';
		if(!empty($nachname))
			$nachname_return = ' value="'.$nachname.'"';
		if(!empty($mail))
			$mail_return = ' value="'.$mail.'"';
		if(!empty($pass))
			$pass_return = ' value="'.$pass.'"';
		if(!empty($geburtsdatum))
			$geburtsdatum_return = ' value="'.$geburtsdatum.'"';
		if(!empty($showname))
			$showname_return = ' value="'.$showname.'"';
			
		
			
			
		echo '
		<form id="register" name="register" method="post" action="'.$_SERVER['PHP_SELF'].'">
		  <table width="617" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="205"><label for="title">title</label></td>
			  <td width="412"><select name="title" id="title">
				<option value="Herr"'; if($titel == "Herr") {echo 'selected="selected"';} echo'>Herr</option>
				<option value="Frau"'; if($titel == "Frau") {echo 'selected="selected"';} echo'>Frau</option>
			  </select></td>
			</tr>
			<tr>
			  <td><label for="vorname">vorname</label></td>
			  <td><input type="text" name="vorname" id="vorname"'.$vorname_return.' />
				  <input type="hidden" name="userid1" id="userid1" value="'.$userid.'" /></td>
			</tr>
			<tr>
			  <td><label for="nachname">nachname</label></td>
			  <td><input type="text" name="nachname" id="nachname"'.$nachname_return.' /></td>
			</tr>
			<tr>
			  <td><label for="email">email</label></td>
			  <td><input type="text" name="email" id="email"'.$mail_return.' /></td>
			</tr>
			<tr>
			  <td><label for="geburtsdatum">geburtsdatum</label></td>
			  <td><input type="date" name="geburtsdatum" id="geburtsdatum"'.$geburtsdatum_return.' /></td>
			</tr>
			<tr>
			  <td><label for="showname">showname</label></td>
			  <td><input type="text" name="showname" id="showname"'.$showname_return.' /></td>
			</tr>
			<tr>
			  <td><label for="passwort">passwort</label></td>
			  <td><input type="password" name="passwort" id="passwort"'.$pass_return.' /></td>
			</tr>
			<tr>
			  <td><label for="passwort_repeat">passwort wiederholen</label></td>
			  <td><input type="password" name="passwort_repeat" id="passwort_repeat"'.$pass_return.' /></td>
			</tr>
			<tr>
			  <td><label for="group">gruppe</label></td>
			  <td><select name="groupid">
				  <option value="2"'; if($groupid == 2) {echo 'selected="selected"';} echo'>Registriert</option>
				  <option value="1"'; if($groupid == 1) {echo 'selected="selected"';} echo'>Administrator</option>
				  </select>
			  </td>
			</tr>
			<tr>
			  <td>
				</td>
			  <td><input type="submit" name="change" id="change" value="Ändern" /></td>
			</tr>
		  </table>
		</form>';
	}
	######################################
	## Daten wurden geändert
	######################################
	if(isset($_POST["change"]))
	{
		
		// Variablen empfangen
		
		$userid = $_POST["userid1"];
		$title = $_POST["title"];
		$vorname = $_POST["vorname"];
		$nachname = $_POST["nachname"];
		$mail = $_POST["email"];
		$geburtsdatum = $_POST["geburtsdatum"];
		$showname = $_POST["showname"];
		$password1 = $_POST["passwort"];
		$groupid = $_POST["groupid"];
		
		// Check changed Password
		/*
		$db = mysql_connect('localhost', 'photowave_prod', 'Bue3vV-phYa!8twT4pOPfBWwW2') or die('Fehler beim Verbinden zum MySQL-Server');
		*/
	
		$sql = "SELECT u.Password
				FROM tblUser AS u
				WHERE UserID = '$userid'";
		/*
		mysql_select_db('photowave_prod', $db) or die ("Datenbank kann nicht ausgewählt werden");
		*/
							 $ergebnis = mysql_query($sql)
								or die('Fehler bei der Datenbankabfrage');
							
							while ($zeile = mysql_fetch_array($ergebnis)) {
							$pass_old = $zeile['Password'];
							}	
//		mysql_close($db);
		
		if($password1 != $pass_old)
			$password1 = md5($password1);
		
		/*
		// Write in DB
		$dbname="photowave_prod"; 
		$dbhost="localhost";
		$dbuser="photowave_prod";
		$dbpass="Bue3vV-phYa!8twT4pOPfBWwW2"; 
				
		$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
		mysql_select_db($dbname,$dbconnection) or die(mysql_error()); 
		*/
		
		$title_sql = mysql_real_escape_string($title, $db_connection);
		$vorname_sql = mysql_real_escape_string($vorname, $db_connection);
		$nachname_sql = mysql_real_escape_string($nachname, $db_connection);
		$mail_sql = mysql_real_escape_string($mail, $db_connection);
		$geburtsdatum_sql = mysql_real_escape_string($geburtsdatum, $db_connection);
		$showname_sql = mysql_real_escape_string($showname, $db_connection);
		$password_sql = mysql_real_escape_string($password1, $db_connection);
		$userid_sql = mysql_real_escape_string($userid, $db_connection);
		
		/*$query2 = "
			INSERT INTO
				tblUser
				(name, vorname, titel, mail, password, groupid)
			VALUES
				('$nachname_sql', '$vorname_sql', '$title_sql', '$mail_sql', '$password_sql', '$groupid')
		";
		$query = '
			DELETE FROM tblUser 
			WHERE UserID = "'.$userid.'";
			';
		*/
		$query = "
				UPDATE tblUser
				SET Name = '$nachname_sql',
					Vorname = '$vorname_sql',
					Titel = '$title_sql',
					Mail = '$mail_sql',
					Geburtsdatum = '$geburtsdatum_sql',
					Showname = '$showname_sql',
					Password = '$password_sql',
					GroupID = '$groupid'
				WHERE UserID = '$userid'
				";
		
		mysql_query($query, $db_connection) or die(mysql_error());
		echo '<br /><b>Data updated successfully!</b><br />';

	}
}
elseif($_SESSION["groupid"] == 2)
{
	if(!isset($_POST["change"]))
	{
		#########################################################
		## Direkt von Benutzerverwaltung (keine Daten geändert)
		#########################################################
		// Post variabel (UserID) empfangen
		$id = $_SESSION["userid"];
		
		/*
		// SQL abfrage
		$db = mysql_connect('localhost', 'photowave_prod', 'Bue3vV-phYa!8twT4pOPfBWwW2') or die('Fehler beim Verbinden zum MySQL-Server');
		*/
		
		$sql = 'SELECT u.UserID, u.Name, u.Vorname, u.Titel, u.Mail, u.Password, u.GroupID, u.Geburtsdatum, u.Showname
				FROM tblUser AS u
				WHERE UserID = "'.$id.'"';
		/*
		mysql_select_db('photowave_prod', $db) or die ("Datenbank kann nicht ausgewählt werden");
								
									or die('Fehler bei der Datenbankabfrage');
		*/
		$ergebnis = mysql_query($sql)
		or die('Fehler bei der Datenbankabfrage');
		
		
		while ($zeile = mysql_fetch_array($ergebnis)) {
							$userid = $zeile['UserID'];
							$nachname = $zeile['Name'];
							$vorname = $zeile['Vorname'];
							$titel = $zeile['Titel'];
							$mail = $zeile['Mail'];
							$pass = $zeile['Password'];
							$groupid = $zeile['GroupID'];
							$geburtsdatum = $zeile['Geburtsdatum'];
							$showname = $zeile['Showname'];
		}
		
//								mysql_close($db);
								
		######################################
		## Ausgabe und abfüllen der Felder
		######################################
		
		if(!empty($vorname))
			$vorname_return = ' value="'.$vorname.'"';
		if(!empty($nachname))
			$nachname_return = ' value="'.$nachname.'"';
		if(!empty($mail))
			$mail_return = ' value="'.$mail.'"';
		if(!empty($pass))
			$pass_return = ' value="'.$pass.'"';
		if(!empty($geburtsdatum))
			$geburtsdatum_return = ' value="'.$geburtsdatum.'"';
		if(!empty($showname))
			$showname_return = ' value="'.$showname.'"';
			
		
			
			
		echo '
		<form id="register" name="register" method="post" action="'.$_SERVER['PHP_SELF'].'">
		  <table width="617" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td width="205"><label for="title">title</label></td>
			  <td width="412"><select name="title" id="title">
				<option value="Herr"'; if($titel == "Herr") {echo 'selected="selected"';} echo'>Herr</option>
				<option value="Frau"'; if($titel == "Frau") {echo 'selected="selected"';} echo'>Frau</option>
			  </select></td>
			</tr>
			<tr>
			  <td><label for="vorname">vorname</label></td>
			  <td><input type="text" name="vorname" id="vorname"'.$vorname_return.' />
				  <input type="hidden" name="userid1" id="userid1" value="'.$userid.'" /></td>
			</tr>
			<tr>
			  <td><label for="nachname">nachname</label></td>
			  <td><input type="text" name="nachname" id="nachname"'.$nachname_return.' /></td>
			</tr>
			<tr>
			  <td><label for="email">email</label></td>
			  <td><input type="text" name="email" id="email"'.$mail_return.' /></td>
			</tr>
			<tr>
			  <td><label for="geburtsdatum">geburtsdatum</label></td>
			  <td><input type="date" name="geburtsdatum" id="geburtsdatum"'.$geburtsdatum_return.' /></td>
			</tr>
			<tr>
			  <td><label for="showname">showname</label></td>
			  <td><input type="text" name="showname" id="showname"'.$showname_return.' /></td>
			</tr>
			<tr>
			  <td><label for="passwort">passwort</label></td>
			  <td><input type="password" name="passwort" id="passwort"'.$pass_return.' /></td>
			</tr>
			<tr>
			  <td><label for="passwort_repeat">passwort wiederholen</label></td>
			  <td><input type="password" name="passwort_repeat" id="passwort_repeat"'.$pass_return.' /></td>
			</tr>
			<tr>
			  <td>
				</td>
			  <td><input type="submit" name="change" id="change" value="Ändern" /></td>
			</tr>
		  </table>
		</form>';
	}
	######################################
	## Daten wurden geändert
	######################################
	if(isset($_POST["change"]))
	{
		
		// Variablen empfangen
		
		$userid = $_POST["userid1"];
		$title = $_POST["title"];
		$vorname = $_POST["vorname"];
		$nachname = $_POST["nachname"];
		$mail = $_POST["email"];
		$geburtsdatum = $_POST["geburtsdatum"];
		$showname = $_POST["showname"];
		$password1 = $_POST["passwort"];
		$groupid = $_SESSION["groupid"];
		
		// Check changed Password
		$sql = "SELECT u.Password
				FROM tblUser AS u
				WHERE UserID = '$userid'";


							 $ergebnis = mysql_query($sql)
								or die('Fehler bei der Datenbankabfrage');
							
							while ($zeile = mysql_fetch_array($ergebnis)) {
							$pass_old = $zeile['Password'];
							}	
//		mysql_close($db);
		
		if($password1 != $pass_old)
			$password1 = md5($password1);
		
// Write in DB
		
		$title_sql = mysql_real_escape_string($title, $db_connection);
		$vorname_sql = mysql_real_escape_string($vorname, $db_connection);
		$nachname_sql = mysql_real_escape_string($nachname, $db_connection);
		$mail_sql = mysql_real_escape_string($mail, $db_connection);
		$geburtsdatum_sql = mysql_real_escape_string($geburtsdatum, $db_connection);
		$showname_sql = mysql_real_escape_string($showname, $db_connection);
		$password_sql = mysql_real_escape_string($password1, $db_connection);
		$userid_sql = mysql_real_escape_string($userid, $db_connection);
		
		/*$query2 = "
			INSERT INTO
				tblUser
				(name, vorname, titel, mail, password, groupid)
			VALUES
				('$nachname_sql', '$vorname_sql', '$title_sql', '$mail_sql', '$password_sql', '$groupid')
		";
		$query = '
			DELETE FROM tblUser 
			WHERE UserID = "'.$userid.'";
			';
		*/
		$query = "
				UPDATE tblUser
				SET Name = '$nachname_sql',
					Vorname = '$vorname_sql',
					Titel = '$title_sql',
					Mail = '$mail_sql',
					Geburtsdatum = '$geburtsdatum_sql',
					Showname = '$showname_sql',
					Password = '$password_sql',
					GroupID = '$groupid'
				WHERE UserID = '$userid'
				";
		
		mysql_query($query, $db_connection) or die(mysql_error());
		echo '<br /><b>Data updated successfully!</b><br />';

	}
}
else
###############################
## Wenn nicht eingeloggt:
###############################
{
	echo '<p>Sie sind nicht berechtigt diese Seite zu sehen.</p>';
}
include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>
