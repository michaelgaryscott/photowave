<?php
include 'includes/config.php';
$title = 'Benutzerübersicht';
include 'includes/header-include.php';
###############################
## Zugriff nur für Admins
###############################
if($_SESSION["groupid"] == 1)
{	
	if(isset($_POST["edit"]))
		{
			echo 'Editiere '.$_POST["userid"].'<br />';
		}
	if(isset($_POST["del"]))
	{
		// Fotos des Benutzers löschen
		// Check gibt es "FOTO"?
		$sql = 	'
			SELECT *
			FROM tblfoto
			WHERE
				UserID = "'.mysql_real_escape_string($_POST['userid']).'"
		';

		$foto_sql = mysql_query($sql);
		
		while ($foto = mysql_fetch_array($foto_sql)) {
			
			// Foto löschen HD
			unlink(realpath('./uploads/'.$foto['FotoName']));
			unlink(realpath('./uploads/thumb_'.$foto['FotoName']));
			//var_dump(realpath('./uploads/thumb_'.$foto['FotoName']));
		}
		
		
		// User in DB löschen
		$sql = 'DELETE FROM tblUser 
				WHERE UserID = "'.$_POST["userid"].'"';

		mysql_query($sql) or die(mysql_error());
		
		// echo 'Lösche '.$_POST["userid"].'<br />';
	}
	
	$sql = "SELECT u.UserID, u.Name, u.Vorname, u.Titel, u.Mail, u.Password, u.GroupID, u.Geburtsdatum, u.Showname
			FROM tblUser AS u
			ORDER BY Name";
	/*
	mysql_select_db('photowave_prod', $db) or die ("Datenbank kann nicht ausgewählt werden");
	*/
	$ergebnis = mysql_query($sql);
//							or die('Fehler bei der Datenbankabfrage')
	
	echo ("<table border=\"0\" width=\"100%\">");
	echo ("<tr>");
	echo ('<td width="60"><b>UserID</b></td>');
	echo ('<td width="170"><b>Benutzer</b></td>');		
	echo ('<td width="230"><b>Mail</b></td>');
	echo ('<td width="60"><b>GroupID</b></td>');
	echo ('<td width="60"><b>Showname</b></td>');
	echo ('<td width="55"><b>Delete</b></td>');
	echo ('<td width="55"><b>Bearbeiten</b></td>');
	echo ("</tr>");		
		
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
		
						
		echo ("<tr>");			
		echo ("<td>$userid</td>");
		echo ("<td>$nachname, $vorname</td>");
		echo ("<td>$mail</td>");
		echo ("<td>$groupid</td>");
		echo ("<td>$showname</td>");
		echo ('<td><div>
		<form action="'.$_SERVER['PHP_SELF'].'" method="POST" name="user">
		<input type="submit" name="del" value="del">
		<input type="hidden" name="userid" value="'.$userid.'">
		</form>
		</div></td>');
		echo ('<td>
		<form action="benutzer.php" method="POST" name="user">
		<input type="submit" name="edit" value="edit">
		<input type="hidden" name="userid" value="'.$userid.'">
		</form></td>');
		echo ("</tr>");					 
	}
	
	echo("</table>");

}
	
else
###############################
## Wenn nicht Admin:
###############################
{
	echo '<p>Sie sind nicht berechtigt diese Seite zu sehen.</p>';
}

include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>