<script type="text/javascript"> 

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}



function loadpos(){
if (getCookie("doscroll") == 1) {
window.scrollTo(0,getCookie("poss"));
setCookie("doscroll",0,365);
}

}

function savepos(){
setCookie("poss",window.pageYOffset,365);
}


function scrollit(){
setCookie("doscroll",1, 365);
}

</script>
<?php

include 'includes/config.php';
$menu_active = 'Photostream';
$title = 'Photostream';
include 'includes/header-include.php';
if(isset($_SESSION["userid"]))
{
$zahl = 5;
$count = 0;	
	
	// Main Part
	
	If ($_POST["zahl"] <= 5)
	{
		$zahl = 5;
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
	
	while ($zeile = mysql_fetch_array($ergebnis)) {
		$fotopath = $zeile['FotoPath'];
		
		
		$sql2=' SELECT x.FotoPath, x.UserID, x.Datum, x.FotoID, y.UserID, y.Showname
				FROM tblfoto as x INNER JOIN tbluser as y ON x.UserID = y.UserID
				WHERE x.FotoPath = "'.$fotopath.'"';
				
			
		$ergebnis2 = mysql_query($sql2);	
		//Hier werden die Anzahl Post abgefangen nur 5 angezeigt bis man auf mehr post Anzeigen klickt.
		while ($count < $zahl && $zeile2 = mysql_fetch_array($ergebnis2)) {
		
			$showname = $zeile2['Showname'];
			$data = $zeile2['Datum'];
			$posttime= date("d/ M/ Y G:i ", strtotime($data));
			$count++;
			
			// Wer mag dieses Foto?
			$photoid = $zeile2['FotoID'];
			$sql_like = "SELECT * FROM tbllikes WHERE
				UserID='$userid_self' AND
				FotoID='$photoid'
				LIMIT 1";
			
			
			// Prüfen, das Foto jemandem gefällt...
			//$_res = mysql_query($sql_like, $db_connection) or die(mysql_error());
			$_res = mysql_query($sql_like);
			$_anzahl = @mysql_num_rows($_res);
			
			// HIer geschieht die ganze Ausgabe der Bilder und der Likes in Form einer Tabelle
			echo '<tr>';
			echo '<td align="center"><img src="'.$fotopath.'" alt="Thumbnail"></td>';
			echo '<td>&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td align="center">Postet by '.$showname.' am '.$posttime.'Fotoid: '.$photoid.'Count:'.$count.'Zahl:'.$zahl.'</td>';
			
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
	//Hier wird der Mehr Posts Button angezeigt und eingerichtet, danach werden 10 Posts geladen.
	$zahlre = $zahl+5;
	echo '<tr>';
			echo '<td align="center">';
			echo'<form action="photostream.php" method="post" OnClick="scrollit();">
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
		echo 'window.location.href="'.$url.'"; ';
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