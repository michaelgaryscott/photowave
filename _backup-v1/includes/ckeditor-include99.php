<?php
/*
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <head>
 <title>CKEditor</title>
 <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WYSWIG Editor</title>
</head>

<body>
*/
/*
require("ckeditor/ckeditor_php5.php");

include_once 'ckeditor/ckeditor.php';
 
$ckeditor = new CKEditor();
$ckeditor->basePath = '/ckeditor/';
$ckeditor->config['filebrowserBrowseUrl'] = '/ckfinder/ckfinder.html';
$ckeditor->config['filebrowserImageBrowseUrl'] = '/ckfinder/ckfinder.html?type=Images';
$ckeditor->config['filebrowserFlashBrowseUrl'] = '/ckfinder/ckfinder.html?type=Flash';
$ckeditor->config['filebrowserUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
$ckeditor->config['filebrowserImageUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
$ckeditor->config['filebrowserFlashUploadUrl'] = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
$ckeditor->editor('CKEditor1');
*/


?>
<?php
echo '<script type="text/javascript" src="ckeditor/ckeditor.js"></script>';
$ip = $_SERVER['REMOTE_ADDR'];

echo '

<form action="'.$SERVER['PHP_SELF'].'" method="post">
  <textarea  class="ckeditor" cols="80" rows="10" name="editor" id="editor" >
</textarea>
</form>
';

if ( isset( $_POST["editor"] ) )
$postArray = $_POST ; // 4.1.0 oder höher, benutze $_POST
foreach ( $postArray as $sForm => $value )
{
if ( get_magic_quotes_gpc() )
$postedValue = ( stripslashes( $value ) ) ;
else
$postedValue = ( $value ) ;

$postedValue_safe = $postedValue;

# DB Write

$dbname="asameli_guestbook"; 
$dbhost="localhost";
$dbuser="samelidb";
$dbpass="admin123-!"; 

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

$url = $_SERVER['PHP_SELF'];
echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
echo '</noscript>';
############################################

// file_put_contents('information.txt',"$postedValue", FILE_APPEND);
 }
//  require('information.txt');
# echo '<\/script>';
?>

</body>
</html>
