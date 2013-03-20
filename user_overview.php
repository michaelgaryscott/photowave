<?php
include 'includes/config.php';
$menu_active = 'Freunde Finden';
$title = 'Benutzerübersicht';
include 'includes/header-include.php';
############################
######## Main Part #########
############################

// Ist Benutzer eingeloggt?
if(isset($_SESSION["userid"]))
{
	// SQL Abfrage Variablen
	$userid_self = $_SESSION["userid"];
	
	
	$sql_list = "SELECT u.UserID, u.Name, u.Vorname, u.Titel, u.Mail, u.Password, u.GroupID, u.Geburtsdatum, u.Showname
				FROM tblUser AS u
				WHERE $userid_self <> u.UserID
				ORDER BY Name";


	$ergebnis = mysql_query($sql_list) or die(mysql_error());
	
	// Auflistung aller Benutzer, ausser dem eigenen
	echo ("<table border=\"0\" width=\"100%\">");
	echo ("<tr>");
	echo ('<td width="60"><b>UserID</b></td>');
	echo ('<td width="170"><b>Benutzer</b></td>');		
	echo ('<td width="230"><b>Mail</b></td>');
//	echo ('<td width="60"><b>GroupID</b></td>');
	echo ('<td width="60"><b>Showname</b></td>');
	echo ('<td width="55"><b>Follow</b></td>');
	echo ("</tr>");		

	while ($zeile = mysql_fetch_array($ergebnis)) {
		$userid = $zeile['UserID'];
		$nachname = $zeile['Name'];
		$vorname = $zeile['Vorname'];
		$titel = $zeile['Titel'];
		$titel = $zeile['Titel'];
		$mail = $zeile['Mail'];
		$pass = $zeile['Password'];
		$groupid = $zeile['GroupID'];
		$geburtsdatum = $zeile['Geburtsdatum'];
		$showname = $zeile['Showname'];

		$sql_follower = "SELECT * FROM tblfollow WHERE
						UserID='$userid_self' AND
						FriendID='$userid'
						LIMIT 1";
				
		
		// Prüfen, ob der User in der Datenbank existiert !
		$_res = mysql_query($sql_follower, $db_connection) or die(mysql_error());
		$_anzahl = @mysql_num_rows($_res);
		
		
		echo ("<tr>");			
		echo ("<td>$userid</td>");
		echo ("<td>$nachname, $vorname</td>");
		echo ("<td>$mail</td>");
//		echo ("<td>$groupid</td>");
		echo ("<td>$showname</td>");
		if ($_anzahl > 0)
		{
			echo ('<td>
			<form action="user_overview.php" method="POST" name="user">
			<input type="submit" name="del_label" value="Not follow">
			<input type="hidden" name="del" value="'.$userid.'">
			<input type="hidden" name="user_del" value="'.$userid_self.'">
			</form></td>');
			echo ("</tr>");
		}
		else
		{
			echo ('<td>
			<form action="user_overview.php" method="POST" name="user">
			<input type="submit" name="follow" value="follow">
			<input type="hidden" name="friendid" value="'.$userid.'">
			</form></td>');
			echo ("</tr>");
		}
	}
	echo("</table>");
}
else
{
	###############################
	## Wenn nicht eingeloggt:
	###############################
	echo '<p>Sie sind nicht berechtigt diese Seite zu sehen.</p>';
}



if(isset($_POST["follow"]))
{
	// Post Variablen empfangen
	$friendid = $_POST["friendid"];
	$userid_follow = $_SESSION["userid"];

	// Datenbank update bei Follow
	$sql_follow = "
		INSERT INTO
			tblfollow
			(UserID, FriendID)
		VALUES
			('$userid_follow', '$friendid')
	";

	mysql_query($sql_follow, $db_connection) or die(mysql_error());

	// Site-Refresh
	$url = $_SERVER['PHP_SELF'];
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$url.'";';
	echo '</script>';
	echo '<noscript>';
	echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
	echo '</noscript>';

}

if(isset($_POST["del"]))
{
	// Variablen empfangen
	$friendid_del = $_POST["del"];
	$userid_del = $_POST["user_del"];
	
	
	// SQL Query
	$sql_delete = "DELETE FROM tblfollow 
						WHERE FriendID = $friendid_del AND
						UserID = $userid_del";

	mysql_query($sql_delete, $db_connection) or die(mysql_error());

	echo '<br>Friend ID: '.$friendid_del.'<br>'; 
	echo '<br>User ID: '.$userid_del.'<br>'; 
	echo $sql_delete;
	
	// Site-Refresh
	$url = $_SERVER['PHP_SELF'];
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$url.'";';
	echo '</script>';
	echo '<noscript>';
	echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
	echo '</noscript>';
}



############################
########### End ############
############################
include 'includes/sidebar-include.php';
include 'includes/footer-incude.php';
?>