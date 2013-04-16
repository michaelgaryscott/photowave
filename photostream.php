<?php

include 'includes/config.php';
$menu_active = 'Photostream';
$title = 'Photostream';
include 'includes/header-include.php';
if(isset($_SESSION["userid"]))
{
$zahl = 4;
	
	// Main Part
	If ($_POST["zahl"] <= 4)
	{
		$zahl = 4;
	}
	else
	{
		$zahl = $_POST["zahl"];
	}
		
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
	
	echo '	<div><br />
			<div id="Wrapper">
			<div align="left">
			<form action="processupload.php" method="post" enctype="multipart/form-data" id="UploadForm">
			<tr>
			<td align="center"><input name="ImageFile" type="file" /> <input type="submit"  id="SubmitButton" value="Upload" /></td>
			</tr>
			</form>
			<div id="output"></div>
			</div>
			</div>
			</div>';
			
	// Benötigte Variablen
	// Eigene Benuzuer id
	$userid_self = $_SESSION["userid"];
	
	$sql=' SELECT u.UserID, u.FriendID, f.UserID, f.FotoPath, f.Datum
			FROM tblfollow as u INNER JOIN tblfoto as f ON u.FriendID = f.UserID
			WHERE u.UserID = "'.$_SESSION["userid"].'"
			ORDER by f.Datum DESC';
			
	$ergebnis = mysql_query($sql);
	
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
	$count = 0;	
	while ($zeile = mysql_fetch_array($ergebnis)) {
		$fotopath = $zeile['FotoPath'];
		
		
		$sql2=' SELECT x.FotoPath, x.UserID, x.Datum, x.FotoID, y.UserID, y.Showname
				FROM tblfoto as x INNER JOIN tbluser as y ON x.UserID = y.UserID
				WHERE x.FotoPath = "'.$fotopath.'"';
				
			
		$ergebnis2 = mysql_query($sql2);		
		while ($zeile2 = mysql_fetch_array($ergebnis2) && $count <= $zahl) {
			$showname = $zeile2['Showname'];
			$data = $zeile2['Datum'];
			$posttime= date("d/ M/ Y g:i ", strtotime($data));
			$count++;
			// Wer mag dieses Foto?
			$zeile3 = mysql_fetch_array(mysql_query($sql2));
			$photoid = $zeile3['FotoID'];
			$sql_like = "SELECT * FROM tbllikes WHERE
				UserID='$userid_self' AND
				FotoID='$photoid'
				LIMIT 1";
				
			// Prüfen, das Foto jemandem gefällt...
			$_res = mysql_query($sql_like, $db_connection) or die(mysql_error());
			$_anzahl = @mysql_num_rows($_res);
			
			echo '<tr>';
			echo '<td align="center"><img src="'.$fotopath.'" alt="Thumbnail"></td>';
			echo '<td>&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td align="center">Postet by '.$showname.' am '.$posttime.'Fotoid: '.$photoid.'</td>';
			
			// Mag jemand dieses Foto?
			if ($_anzahl == 0)
			{
				echo ('<td>
				<form action="photostream.php" method="POST" name="like">
				<input type="submit" name="like_label" value="Like">
				<input type="hidden" name="like_who" value="'.$photoid.'">
				</form></td>');
				//echo ("</tr>");
			}
			else
			{
				echo ('<td>
				<form action="photostream.php" method="POST" name="dislike">
				<input type="submit" name="dislike_label" value="Dislike">
				<input type="hidden" name="like_del" value="'.$photoid.'">
				</form></td>');	
			}
			echo '</tr>';
		}
	}
	$zahlre = $zahl+5;
	echo '<tr>';
			echo '<td align="center">';
			echo'<form action="photostream.php" method="post">
			<input type="hidden" name="zahl" value='.$zahlre.' />
			<input type="submit" name="submit" value="Mehr Posts Laden" />
			</form>';
			echo '</td>';
	echo '</tr>';
	echo '</table>';
	
	// Like hinzufügen
	if(isset($_POST["like_label"]))
	{
		// Post Variablen empfangen
		$liked_photo = mysql_real_escape_string($_POST["like_who"]);
		$userid_like = mysql_real_escape_string($_SESSION["userid"]);
		
		echo '<br> Liked Photo: '.$liked_photo.'<br>';
		echo '<br> User who Photo like: '.$userid_like.'<br>';

		// Datenbank update bei Like
		$sql_like = "
			INSERT INTO
				tbllikes
				(UserID, FotoID)
			VALUES
				('$userid_like', '$liked_photo')
		";

		mysql_query($sql_like, $db_connection) or die(mysql_error());
		
		// Site-Refresh
		$url = $_SERVER['PHP_SELF'];
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		echo '</noscript>';
		
	}
	
	
	// Like entfernen
	if(isset($_POST["dislike_label"]))
	{
		// Variablen empfangen
		$photoid_dislike = mysql_real_escape_string($_POST["like_del"]);
		$userid_dislike = mysql_real_escape_string($_SESSION["userid"]);
		
		
		// SQL Query
		$sql_delete = "DELETE FROM tbllikes
							WHERE UserID = $userid_dislike AND
							FotoID = $photoid_dislike";

		mysql_query($sql_delete, $db_connection) or die(mysql_error());
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
	
	
}	
else {
	echo 'Sie sind nicht berechtigt diese Seite zu sehen.';
}
						
	/*$sql = 	'SELECT u.UserID, u.FriendID
			FROM tblfollow as u
			WHERE u.UserID = "'.$_SESSION["userid"].'"';
		

	$ergebnis = mysql_query($sql);
						 	
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
        
	while ($zeile = mysql_fetch_array($ergebnis)) {
	$friendid = $zeile['FriendID'];
	
		$sql2 =' 	SELECT f.UserID, f.FotoPath, f.Datum
					FROM tblfoto as f
					WHERE f.UserID = "'.$friendid.'"
					ORDER BY f.Datum';
					
					$ergebnis2 = mysql_query($sql2);
					while ($zeile2 = mysql_fetch_array($ergebnis2)){
						$fotopath = $zeile2['FotoPath'];
						echo '<tr>';
						echo '<td align="center"><img src="'.$fotopath.'" alt="Thumbnail"></td>';
						echo '</tr>';
						
				}
	}
	
	echo '</table>';
}*/


include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>