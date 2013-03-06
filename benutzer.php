<?php
include("includes/header-include.php");
echo '
<div class="cleared reset-box"></div>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
                                <h2 class="art-postheader">Willkommen!
                                </h2>
                                                <div class="art-postcontent">
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%;">

	
        
';

###############################
## Zugriff nur für Admins
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
		
		// SQL abfrage
		$db = mysql_connect('localhost', 'photowave_prod', 'Bue3vV-phYa!8twT4pOPfBWwW2') or die('Fehler beim Verbinden zum MySQL-Server');
		
		
		$sql = 'SELECT u.UserID, u.Name, u.Vorname, u.Titel, u.Mail, u.Password, u.GroupID
				FROM tblUser AS u
				WHERE UserID = "'.$id.'"';
		
		mysql_select_db('photowave_prod', $db) or die ("Datenbank kann nicht ausgewählt werden");
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
								}
								
								mysql_close($db);
								
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
		$password1 = $_POST["passwort"];
		$groupid = $_POST["groupid"];
		
		// Check changed Password
		
		$db = mysql_connect('localhost', 'photowave_prod', 'Bue3vV-phYa!8twT4pOPfBWwW2') or die('Fehler beim Verbinden zum MySQL-Server');
	
	
		$sql = "SELECT u.Password
				FROM tblUser AS u
				WHERE UserID = '$userid'";
	
		mysql_select_db('photowave_prod', $db) or die ("Datenbank kann nicht ausgewählt werden");
							 $ergebnis = mysql_query($sql)
								or die('Fehler bei der Datenbankabfrage');
							
							while ($zeile = mysql_fetch_array($ergebnis)) {
							$pass_old = $zeile['Password'];
							}	
		mysql_close($db);
		
		if($password1 != $pass_old)
			$password1 = md5($password1);
		
		// Write in DB
		$dbname="photowave_prod"; 
		$dbhost="localhost";
		$dbuser="photowave_prod";
		$dbpass="Bue3vV-phYa!8twT4pOPfBWwW2"; 
		
		$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
		mysql_select_db($dbname,$dbconnection) or die(mysql_error()); 
		
		$title_sql = mysql_real_escape_string($title, $dbconnection);
		$vorname_sql = mysql_real_escape_string($vorname, $dbconnection);
		$nachname_sql = mysql_real_escape_string($nachname, $dbconnection);
		$mail_sql = mysql_real_escape_string($mail, $dbconnection);
		$password_sql = mysql_real_escape_string($password1, $dbconnection);
		$userid_sql = mysql_real_escape_string($userid, $dbconnection);
		
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
					Password = '$password_sql',
					GroupID = '$groupid'
				WHERE UserID = '$userid'
				";
		
		mysql_query($query, $dbconnection) or die(mysql_error());
		echo '<br /><b>Data updated successfully!</b><br />';

	}
}
else
###############################
## Wenn nicht Admin:
###############################
{
	echo '<p>Sie sind nicht berechtigt diese Seite zu sehen.</p>';
}


echo '
	        
    </div>
    </div>
</div>

                </div>
                <div class="cleared"></div>
                </div>

		<div class="cleared"></div>
    </div>
</div>';
include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>