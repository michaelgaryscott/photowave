<?php
include 'includes/config.php';
$title = 'Profilfoto';
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
if(isset($_SESSION["userid"])) {
	
	if (isset($_POST['set_foto'])) {
		
		// Check gibt es "FOTO"?
		$sql = 	'
			UPDATE tbluser 
				SET ProfilephotoID = '.$_POST['id'].' 
			WHERE UserID = '.$_SESSION["userid"].'
		';
		//echo '<br>SQL: '.$sql.'<br>';
		echo '<br><b><font size=2>Das Foto wurde erfolgreich als Profilbild gesetzt!</font></b><br>';
	 	mysql_query($sql);
	
	
	}
	
	
	
	// Main Part
	$sql = 	'
		SELECT *
		FROM tblfoto
		WHERE
			UserID = "'.$_SESSION["userid"].'"
	';
	
	$ergebnis = mysql_query($sql);
	$anzahl = @mysql_num_rows($ergebnis);
	if ($anzahl > 0) {
		while ($zeile = mysql_fetch_array($ergebnis)) {
			echo '
			<div>
				<form action="" method="post" OnClick="scrollit();">
					<input type="hidden" name="id" value="'.$zeile['FotoID'].'" />
					<img src="uploads/thumb_'.$zeile['FotoName'].'" alt="Thumbnail">
					<input type="submit" name="set_foto" value="Foto auswählen" />
				</form>
			</div>';
		}
	} else {
		echo '<p>Du hast keine Fotos</p>';
	}


} else {
	echo 'Sie sind nicht berechtigt diese Seite zu sehen.';
}
############################
########### End ############
############################
include 'includes/sidebar-include.php';
include 'includes/footer-incude.php';
?>