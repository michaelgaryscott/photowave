<?php
include 'includes/config.php';
$menu_active = 'Freunde Finden';
include 'includes/header-include.php';
	
echo '
<div class="cleared reset-box"></div>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
                                <h2 class="art-postheader">Benutzerübersicht
                                </h2>
                                                <div class="art-postcontent">
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%;">
        <p>';
############################
######## Main Part #########
############################
// Ist Benutzer eingeloggt?
if(isset($_SESSION["userid"]))
{
	$friendid = $_POST["friendid"];

//	$userid_sql = mysql_real_escape_string($_SESSION["userid"], $db_connection);
//	$friendid_sql = mysql_real_escape_string($friendid, $db_connection);
	
	$sql_follow = "
	INSERT INTO
		tblfollow
		(userid, friendid)
	VALUES
		('$userid_sql', '$friendid_sql')
	";
	
	$sql = "SELECT u.UserID, u.Name, u.Vorname, u.Titel, u.Mail, u.Password, u.GroupID, u.Geburtsdatum, u.Showname
		FROM tblUser AS u
		ORDER BY Name";

	$ergebnis = mysql_query($sql);
	or die('Fehler bei der Datenbankabfrage')
							
	echo ("<table border=\"0\" width=\"100%\">");
	echo ("<tr>");
	echo ('<td width="170"><b>Benutzer</b></td>');		
	echo ('<td width="230"><b>Mail</b></td>');
	echo ('<td width="60"><b>Showname</b></td>');
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
	echo ("<td>$nachname, $vorname</td>");
	echo ("<td>$mail</td>");
	echo ("<td>$showname</td>");
	echo ('<td><div>
	<form action="'.$_SERVER['PHP_SELF'].'" method="POST" name="follow">
	<input type="submit" name="follow" value="follow">
	<input type="hidden" name="friendid" value="'.$userid.'">
	</form>
	</div></td>');
	echo ("</tr>");					 
		}

	echo("</table>");
	if(isset($_POST["edit"]))
		{
			echo 'Editiere '.$_POST["userid"].'<br />';
		}
	if(isset($_POST["del"]))
	{
		/*
		$db = mysql_connect('localhost', 'photowave_prod', 'Bue3vV-phYa!8twT4pOPfBWwW2') or die('Fehler beim Verbinden zum MySQL-Server');
		*/

			$sql = 'DELETE FROM tblUser 
					WHERE UserID = "'.$_POST["userid"].'"';
			/*
			mysql_select_db('photowave_prod', $db) or die ("Datenbank kann nicht ausgewählt werden");
			or die('Fehler bei der Datenbankabfrage');
			*/
			$ergebnis = mysql_query($sql);
			$url = $_SERVER['PHP_SELF'];
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			echo '</noscript>';
	
		echo 'Lösche '.$_POST["userid"].'<br />';
	}
	echo("<p>");
}
else
	echo 'Sie sind nicht berechtigt diese Seite zu sehen.';
	

############################
########### End ############
############################
echo'
    </div>
    </div>
</div>

                </div>
                <div class="cleared"></div>
                </div>

		<div class="cleared"></div>
    </div>
</div>';

include 'includes/sidebar-include.php';
include 'includes/footer-incude.php';
?>