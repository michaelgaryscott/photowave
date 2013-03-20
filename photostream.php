<?php

include 'includes/config.php';
$menu_active = 'Photostream';
$title = 'Photostream';
include 'includes/header-include.php';

if(isset($_SESSION["userid"]))
{
	
	// Main Part
	echo '	<div><br />
			<div id="Wrapper">
			<div align="left">
			<form action="processupload.php" method="post" enctype="multipart/form-data" id="UploadForm">
			<input name="ImageFile" type="file" />
			<input type="submit"  id="SubmitButton" value="Upload" />
			</form>
			<div id="output"></div>
			</div>
			</div>
			</div>';
	
	$sql=' SELECT u.UserID, u.FriendID, f.UserID, f.FotoPath, f.Datum
			FROM tblfollow as u INNER JOIN tblfoto as f ON u.FriendID = f.UserID
			WHERE u.UserID = "'.$_SESSION["userid"].'"
			ORDER by f.Datum DESC';
			
	$ergebnis = mysql_query($sql);
	
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
	
	while ($zeile = mysql_fetch_array($ergebnis)) {
	$fotopath = $zeile['FotoPath'];
	
	$sql2=' SELECT x.FotoPath, x.UserID, x.Datum, y.UserID, y.Showname
			FROM tblfoto as x INNER JOIN tbluser as y ON x.UserID = y.UserID
			WHERE x.FotoPath = "'.$fotopath.'"';
			
	$ergebnis2 = mysql_query($sql2);		
	while ($zeile2 = mysql_fetch_array($ergebnis2)) {
	
	$showname = $zeile2['Showname'];
	$posttime = $zeile2['Datum'];
						echo '<tr>';
						echo '<td align="center"><img src="'.$fotopath.'" alt="Thumbnail"></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td align="center">Postet by '.$showname.' at '.$posttime.'  </td>';
						echo '</tr>';
						}
					}
	echo '</table>';
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
}*/	else {
	echo 'Sie sind nicht berechtigt diese Seite zu sehen.';
}


include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>