<?php
include 'includes/config.php';
$title = 'Profil';
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
############################
######## Main Part #########
############################
// Anzuzeigendes Profil festlegen
if(isset($_GET["userid"]) && isset($_SESSION["userid"]))
{
	$zahl = 5;
	//Funktionen
	function alter($datum)
	{
		list($y, $m, $d) = explode('-', $datum);
		$alter = date('Y') - $y;
		$monat = date('m');
		if ($monat < $m or ($monat == $m and $d > date('d'))) {
			$alter--;
    }
    return $alter;
	}	
	
	// Like hinzufügen
	if(isset($_POST["like_label"]))
	{
		// Post Variablen empfangen
		$liked_photo = mysql_real_escape_string($_POST["like_photo"]);
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
	
	If ($_GET["zahl"] <= 5)
	{
		$zahl = 5;
	}
	else
	{
		$zahl = $_GET["zahl"];
	}
	
	$sql = ' 	SELECT * FROM tblUser
					WHERE UserID = "'.mysql_real_escape_string($_GET["userid"]).'"';
		
	$get_query = mysql_query($sql);
	$user = mysql_fetch_array($get_query);
	
	$sql3= ' SELECT * FROM tblfoto
				WHERE FotoID = '.$user["ProfilephotoID"].'';
				
	$get_query3 = mysql_query($sql3);
	$profilfoto = mysql_fetch_array($get_query3);
	$geburtsdatum = date("d/ M/ Y", strtotime($user["Geburtsdatum"]));	
	
	if($user["GroupID"] == 2)
	$status= "Normaler Benutzer";
	else
	$status= "Admin";
	
	// Ausgabe der Profilinformationen in Form einer Tabelle ohne Rahmen...
	echo'
	<table width="100%" border="0" cellpadding="4" cellspacing="0">
		<tr>
			<td>Showname: '.$user["Showname"].'</td>
			
			';
			// Hier wird abgefange, dass wenn kein Profilbild ausgewählt wurde, trotzdem ein Dummybild gezeigt wird...
			if($profilfoto['FotoName'] == "") {
				echo '<td rowspan="7" align="center"><img src="images/profile.png" height="150" width="150" align="center" alt="Profilbild"></td>';
				
			}
			else {
				echo '<td rowspan="7" align="center"><img src="./uploads/thumb_'.$profilfoto['FotoName'].'" height="150" width="150" align="center" alt="Thumbnail"></td>';
			}
			
	echo'		
		</tr>
		<tr>
			<td>Vorname: '.$user["Vorname"].'</td>
			
		</tr>
		<tr>
			<td>Name: '.$user["Name"].'</td>
			
		</tr>
		<tr>
			<td>Alter: '.alter($user["Geburtsdatum"]).'</td>
			
		</tr>
		<tr>
			<td>Geburtstag: '.$geburtsdatum.'</td>
			
		</tr>
		<tr>
			<td>Mail: '.$user["Mail"].'</td>
			
		</tr>
		<tr>
			<td>Art des Benutzers: '.$status.'</td>
			
		</tr>
	</table>
	';
	
	/*echo 'Showname: '.$user["Showname"].'<br>
		Vorname: '.$user["Vorname"].'<br>
		Name: '.$user["Name"].'<br>
		Alter: '.alter($user["Geburtsdatum"]).'<br>
		Geburtstag:'.$user["Geburtsdatum"].'<br>
		Mail: '.$user["Mail"].'<br>';
		*/
		
	
	
		
	$sql1=' SELECT 
					f.*, u.*, COUNT(l.UserID) AS likes, COUNT(DISTINCT l2.UserID) AS liked
				FROM 
					tblfollow AS w
					INNER JOIN tblfoto AS f ON f.UserID = w.FriendID
					INNER JOIN tbluser AS u ON u.UserID = f.UserID
					LEFT JOIN tbllikes AS l ON l.FotoID = f.FotoID
					LEFT JOIN tbllikes AS l2 ON l2.FotoID = f.FotoID AND l2.UserID = w.UserID
				WHERE 
					f.UserID= "'.$_GET['userid'].'"
				GROUP BY
					f.FotoID
				ORDER BY 
					f.Datum DESC
				LIMIT '.mysql_real_escape_string($zahl);
		
	$ergebnis1 = mysql_query($sql1);
	$anzahl = @mysql_num_rows($ergebnis1);
	if($anzahl > 0)
	{
	echo '<h2>Bilder von '.$user["Showname"].' </h2>';
	echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
	while ($zeile1 = mysql_fetch_array($ergebnis1)) {
	
	// Hier werden die Bilder mit Like funktion in form einer Tabelle ausgegeben, und zwar nur des Users wessen wir das Profil besuchen...
	$posttime = date("d/ M/ Y G:i ", strtotime($zeile1['Datum']));
			echo '
			 <tr>
				<td align="center"><img src="'.$zeile1['FotoPath'].'" alt="Thumbnail"></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
								<td align="center">Postet am '.$posttime.' Likes:'.$zeile1['likes'].'</td>';
			
		
	// Mag jemand dieses Foto?
		if ($zeile1['liked'] == 0)
		{
			echo '<td>
			<form action="" method="POST" name="like" OnClick="scrollit();">
			<input type="submit" name="like_label" value="Like">
			<input type="hidden" name="like_photo" value="'.$zeile1['FotoID'].'">
			</form></td>';
		}
		else
		{
			echo '<td>
			<form action="" method="POST" name="dislike" OnClick="scrollit();">
			<input type="submit" name="dislike_label" value="Dislike">
			<input type="hidden" name="like_del" value="'.$zeile1['FotoID'].'">
			</form></td>';	
		}
		echo '</tr>';
	}
	$zahlre = $zahl+5;
	
	echo '<tr>';
			echo '<td align="center">';
			echo '<a href="profil.php?userid='.$_GET['userid'].'&zahl='.$zahlre.'" OnClick="scrollit();">Mehr Posts Laden</a>';
			echo '</td>';
	echo '</tr>';
		
	echo '</table>';
}
}
else
	echo '<br />Unerlaubter Zugriff auf diese Seite';
	


############################
########### End ############
############################
include 'includes/sidebar-include.php';
include 'includes/footer-incude.php';
?>