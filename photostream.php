<?php
// HEADER
include 'includes/config.php';
$menu_active = 'Photostream';
$title = 'Photostream';
$header[] = '
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
';
include 'includes/header-include.php';

// MAIN
if(isset($_SESSION["userid"]))
{
	$zahl = 5;

	// Like hinzufügen
	if(isset($_POST["like_label"]))
	{
		// Post Variablen empfangen
		$liked_photo = mysql_real_escape_string($_POST["like_who"]);
		$userid_like = mysql_real_escape_string($_SESSION["userid"]);

		// Datenbank update bei Like
		$sql_like = '
			INSERT INTO tbllikes
				(UserID, FotoID)
			VALUES
				("'.$userid_like.'", "'.$liked_photo.'")
		';
		mysql_query($sql_like, $db_connection) or die(mysql_error());
	}
	// Like entfernen
	if(isset($_POST["dislike_label"]))
	{
		// Variablen empfangen
		$photoid_dislike = mysql_real_escape_string($_POST["like_del"]);
		$userid_dislike = mysql_real_escape_string($_SESSION["userid"]);
		
		// SQL Query
		$sql_delete = '
			DELETE FROM tbllikes
			WHERE UserID = '.$userid_dislike.' AND
			FotoID = '.$photoid_dislike;

		mysql_query($sql_delete, $db_connection) or die(mysql_error());
	}
	
	// Main Part
	
	// Hier wird die Anzahl von Post die angezeigt werde festgelegt...
	If ($_GET["zahl"] <= 5)
	{
		$zahl = 5;
	}
	else
	{
		$zahl = $_GET["zahl"];
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
			</div>
			</table>';
		
	$foto_sql=' SELECT 
				f.*, u.*, COUNT(l.UserID) AS likes, COUNT(DISTINCT l2.UserID) AS liked
			FROM 
				tblfollow AS w
				INNER JOIN tblfoto AS f ON f.UserID = w.FriendID
				INNER JOIN tbluser AS u ON u.UserID = f.UserID
				LEFT JOIN tbllikes AS l ON l.FotoID = f.FotoID
				LEFT JOIN tbllikes AS l2 ON l2.FotoID = f.FotoID AND l2.UserID = w.UserID
			WHERE 
				w.UserID = "'.$_SESSION['userid'].'"
			GROUP BY
				f.FotoID
			ORDER BY 
				f.Datum DESC
			LIMIT '.mysql_real_escape_string($zahl);
			
	$foto_query = mysql_query($foto_sql);
	$anzahl = @mysql_num_rows($foto_query);
	
	if($anzahl > 0){
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
		while ($foto = mysql_fetch_array($foto_query)) {
		
			$posttime = date("d/ M/ Y G:i ", strtotime($foto['Datum']));
			
			// HIer geschieht die ganze Ausgabe der Bilder und der Likes in Form einer Tabelle
			echo '<tr>
					<td align="center" valign="bottom"><img src="'.$foto['FotoPath'].'" alt="Thumbnail"></td>
					<td align="left" valign="bottom"> <img src="./images/like_thumb.png" align="absbottom" alt="Like" width="25" height="25"><font size="6" color="104E8B">'.$foto['likes'].'</font></td>
				</tr>
				<tr>
					<td align="center">Postet by <a href="profil.php?userid='.$foto["UserID"].'">'.$foto['Showname'].'</a> am '.$posttime.'</td>';
			
			// Mag jemand dieses Foto?
			if ($foto['liked'] == 0)
			{
				echo '<td>
				<form action="" method="POST" name="like" OnClick="scrollit();">
				<input type="submit" name="like_label" value="Like">
				<input type="hidden" name="like_who" value="'.$foto['FotoID'].'">
				</form></td>';
			}
			else
			{
				echo '<td>
				<form action="" method="POST" name="dislike" OnClick="scrollit();">
				<input type="submit" name="dislike_label" value="Dislike">
				<input type="hidden" name="like_del" value="'.$foto['FotoID'].'">
				</form></td>';	
			}
			echo '</tr>';
		
		}
		//Hier wird der Mehr Posts Button angezeigt und eingerichtet, danach werden 10 Posts geladen.
		$zahlre = $zahl+5;
		echo '<tr>';
				echo '<td align="center">';
	//			echo'<form action="photostream.php" method="get" OnClick="scrollit();">
	//			<input type="hidden" name="zahl" value='.$zahlre.' />
	//			<input type="submit" name="submit" value="Mehr Posts Laden" />
	//			</form>';
				echo '<a href="photostream.php?zahl='.$zahlre.'" OnClick="scrollit();">Mehr Posts Laden</a>';
				echo '</td>';
		echo '</tr>';
		echo '</table>';
		
	}
	else{ 
		  echo "<br>Es sind keine Bilder f&uuml;r die Anzeige verf&uuml;gbar.";
		}
}
else {
	echo 'Sie sind nicht berechtigt diese Seite zu sehen.';
	}



include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>