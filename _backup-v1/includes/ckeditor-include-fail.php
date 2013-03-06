
<?php
$edit = $_GET["b"];

if(!empty($edit))
{
	$edit_beitrag = $_POST["edit_beitrag"];
	
	$db = mysql_connect('localhost', 'samelidb', 'admin123-!') or die('Fehler beim Verbinden zum MySQL-Server');
		
		
		$sql = 'SELECT b.BeitragID, b.Beitrag, b.Datum, b.IP, b.UserID
				FROM tblBeitraege AS b
				WHERE BeitragID = "'.$edit.'"';
		
		mysql_select_db('asameli_guestbook', $db) or die ("Datenbank kann nicht ausgewählt werden");
								$ergebnis = mysql_query($sql)
									or die('Fehler bei der Datenbankabfrage');
								
								
								while ($zeile = mysql_fetch_array($ergebnis)) {
								$beitragid = $zeile['BeitragID'];
								$beitrag = $zeile['Beitrag'];
								$datum = $zeile['Datum'];
								$ip = $zeile['IP'];
								$userid = $zeile['UserID'];
								}
								
								mysql_close($db);
		// $value_edit = ' value="'.$beitrag.'"';
		$value_edit = ' value="Hallo"';
}

echo '<script type="text/javascript" src="ckeditor/ckeditor.js"></script>';
$ip = $_SERVER['REMOTE_ADDR'];

echo '

<form action="'.$SERVER['PHP_SELF'].'" method="post">
  <textarea  class="ckeditor" cols="80" rows="10" name="editor" id="editor" >';
  if(!empty($edit))
  	echo $beitrag;
echo '</textarea>';
	if(!empty($edit))
		echo '<input type="hidden" name="edit_beitrag" id="edit_beitrag" value="'.$edit.'" />';
	
	
echo '
</form>
';

// echo 'Edit: '.$edit;
echo 'Editor: '.$_POST["editor"];
if ( isset( $_POST["editor"] ) )
$postArray = $_POST ; // 4.1.0 oder höher, benutze $_POST
foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
	$postedValue = ( stripslashes( $value ) ) ;
	else
	$postedValue = ( $value ) ;
}
	$postedValue_safe = $postedValue;
	$beitrag = $postedValue;
	$edit_beitrag = $_POST["edit_beitrag"];

	# DB Write (bestehender Beitrag)

	$dbname="asameli_guestbook"; 
	$dbhost="localhost";
	$dbuser="samelidb";
	$dbpass="admin123-!"; 

	if(!empty($edit_beitrag))
	{
		$editor2 = $_POST["editor"];
		$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
		mysql_select_db($dbname,$dbconnection) or die(mysql_error());
		
		$beitrag_sql = mysql_real_escape_string($beitrag, $dbconnection);
		
		// echo 'Beitrag SQL'.$beitrag_sql;
		
		$query = "
			UPDATE tblBeitraege
				SET Beitrag = '$editor2'
				WHERE BeitragID = '$edit'
		";
		echo $query;
		mysql_query($query, $dbconnection) or die(mysql_error());
		/*
		$url = $_SERVER['PHP_SELF'];
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		echo '</noscript>';*/
	}
	# DB Write (neuer Beitrag)
	if(empty($edit))
	{
		$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
		mysql_select_db($dbname,$dbconnection) or die(mysql_error());
		
		$content_sql = mysql_real_escape_string($postedValue_safe, $dbconnection);
		$ip_sql = mysql_real_escape_string($ip, $dbconnection);
		$user_sql = mysql_real_escape_string($_SESSION["userid"], $dbconnection);
		
		$query = "
			INSERT INTO
				tblBeitraege
				(Beitrag, IP, UserID)
			VALUES
				('$content_sql', '$ip_sql', '$user_sql')
		";
		
		mysql_query($query, $dbconnection) or die(mysql_error());
		/*
		$url = $_SERVER['PHP_SELF'];
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		echo '</noscript>';
		*/
		############################################
		
		// file_put_contents('information.txt',"$postedValue", FILE_APPEND);
	}
		//  require('information.txt');
		# echo '<\/script>';

?>
