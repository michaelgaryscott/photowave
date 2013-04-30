<?php
include 'includes/config.php';
$title = 'Profil';
include 'includes/header-include.php';
############################
######## Main Part #########
############################
// Anzuzeigendes Profil festlegen
if(isset($_GET["userid"]) && isset($_SESSION["userid"]))
{
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
	
	$sql = ' 	SELECT * FROM tblUser
					WHERE UserID = "'.mysql_real_escape_string($_GET["userid"]).'"';
		
	$get_query = mysql_query($sql);
	$user = mysql_fetch_array($get_query);
	
	echo 'Showname: '.$user["Showname"].'<br>
		Alter: '.alter($user["Geburtsdatum"]).'<br>';
		
	$sql1 = 	'
		SELECT *
		FROM tblfoto
		WHERE
			UserID = "'.$_GET["userid"].'"
	';
	
	$ergebnis1 = mysql_query($sql1);
	
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
	while ($zeile1 = mysql_fetch_array($ergebnis1)) {
			echo '
			 <tr>
				<td align="center"><img src="'.$zeile1['FotoPath'].'" alt="Thumbnail"></td>
				<td>&nbsp;</td>
			</tr>'
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