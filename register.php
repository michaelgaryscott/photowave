<?php
include 'includes/config.php';
include'includes/header-include.php';
echo '
<div class="cleared reset-box"></div>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
                                <h2 class="art-postheader">Registrieren
                                </h2>
                                                <div class="art-postcontent">
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%;">
        <p>';

error_reporting(0);
$title = $_POST["title"];
$vorname = $_POST["vorname"];
$nachname = $_POST["nachname"];
$geburtsdatum = $_POST["geburtsdatum"];
$mail = $_POST["email"];
$showname= $_POST["showname"]
$password1 = $_POST["passwort"];
$password2 = $_POST["passwort_repeat"];
$forward = 0;

$forward_vorname = 0;
$forward_nachname = 0;
$forward_email = 0;
$forward_pass1 = 0;
$forward_pass2 = 0;
$forward_pass3 = 0;
$forward_captcha = 0;
$forward_geburtsdatum = 0;
$forward_showname = 0;

if(!empty($vorname))
	$return_vorname = ' value="'.$vorname.'"';
if(!empty($nachname))
	$return_nachname = ' value="'.$nachname.'"';
if(!empty($mail))
	$return_mail = ' value="'.$mail.'"';
if(!empty($geburtsdatum))
	$return_geburtsdatum = ' value="'.$geburtsdatum.'"';
if(!empty($showname))
	$return_showname = ' value="'.$showname.'"';
  

echo '
<form id="register" name="register" method="post" action="register.php">
  <table width="617" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="205"><label for="title">title</label></td>
      <td width="412"><select name="title" id="title">
        <option value="Herr"'; if($title == "Herr") {echo 'selected="selected"';} echo'>Herr</option>
        <option value="Frau"'; if($title == "Frau") {echo 'selected="selected"';} echo'>Frau</option>
      </select></td>
    </tr>
    <tr>
      <td><label for="vorname">vorname</label></td>
      <td><input type="text" name="vorname" id="vorname"'.$return_vorname.' /></td>
    </tr>
    <tr>
      <td><label for="nachname">nachname</label></td>
      <td><input type="text" name="nachname" id="nachname"'.$return_nachname.' /></td>
    </tr>
    <tr>
      <td><label for="email">email</label></td>
      <td><input type="text" name="email" id="email"'.$return_mail.' /></td>
    </tr>
	<tr>
      <td><label for="geburtsdatum">geburtsdatum</label></td>
      <td><input type="number" name="geburtsdatum" id="geburtsdatum"'.$return_geurtsdatum.' /></td>
    </tr>
	<tr>
      <td><label for="showname">showname</label></td>
      <td><input type="text" name="showname" id="showname"'.$return_showname.' /></td>
    </tr>
    <tr>
      <td><label for="passwort">passwort</label></td>
      <td><input type="password" name="passwort" id="passwort" /></td>
    </tr>
    <tr>
      <td><label for="passwort_repeat">passwort wiederholen</label></td>
      <td><input type="password" name="passwort_repeat" id="passwort_repeat" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>';
	  
	  

  	// Check Mail validity
	// Funktion erstellen	
	include("includes/mailcheck-func.php");
	$mail_validity = check_email($mail);
	  
	// Captcha	  
  require_once('recaptcha/recaptchalib.php');
  $publickey = "6Lf-DdESAAAAAJt89EKQJWyN5JHRKspdzMdaVOZL"; // you got this from the signup page
  echo recaptcha_get_html($publickey);
  
  
 	// Check Captcha validity
  if(isset($_POST["recaptcha_challenge_field"]))
  {
	   require_once('recaptcha/recaptchalib.php');
	  $privatekey = "6Lf-DdESAAAAAJVwR4ne--rniLhtv4MoKDCIF114";
	  $resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);
	
	  if (!$resp->is_valid) {
		// What happens when the CAPTCHA was entered incorrectly
			/* echo ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
				 "(reCAPTCHA said: " . $resp->error . ")"); */
			$captchareturn = 1;
	  } else {
		// Your code here to handle a successful verification
		$forward_captcha = 1;
	  }
  }
// echo '<br />Mailvalidity: '.$mail_validity.'<br />';
// echo '<br />Mail: '.$mail.'<br />';


  //Check fields
  if(isset($title))
  {
	  echo '<font color="red"><b>';
	  if(empty($vorname))
		echo 'Vorname fehlt.<br />';
	  else
		$forward_vorname = 1;
	  if(empty($nachname))
		echo 'Nachname fehlt.<br />';
	  else
		$forward_nachname = 1;
	  if($mail_validity != 1 or empty($mail_validity))
		echo 'Mail Adresse fehlt oder ist ungültig!<br />';
	  else
		$forward_email = 1;
	  if(empty($geburtsdatum))
		echo 'Geburtdatum fehlt.<br />';
	  else
		$forward_geburtsdatum = 1;
	  if(empty($showname))
		echo 'Showname fehlt.<br />';
	  else
		$forward_showname = 1;
	  if(empty($password1))
		echo 'Password 1 fehlt.<br />';
	  else
		$forward_pass1 = 1;
	  if(empty($password2))
		echo 'Password 2 fehlt.<br />';
	  else
		$forward_pass2 = 1;
	  if(!empty($password1) and ($password1 != $password2))
		echo 'Passwörter stimmen nicht überein.<br />';
	  else
		$forward_pass3 = 1;
	  if(isset($captchareturn))
	  	echo 'Captcha eingabe ungültig! Bitte versuchen Sie es erneuert.';
	  echo '</b></font>';
  }
// Forwarding definieren
if($forward_captcha == 1 and $forward_email == 1 and $forward_nachname == 1 and $forward_pass1 == 1 and $forward_pass2 == 1 and $forward_pass3 == 1 and $forward_vorname == 1)
{
	$forward = 1;
}

if ($forward == 1)
{
		
/*
// Write in DB
$dbname="photowave_prod"; 
$dbhost="localhost";
$dbuser="photowave_prod";
$dbpass="Bue3vV-phYa!8twT4pOPfBWwW2"; 

$dbconnection = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname,$dbconnection) or die(mysql_error()); 
*/
$title_sql = mysql_real_escape_string($title, $db_connection);
$vorname_sql = mysql_real_escape_string($vorname, $db_connection);
$nachname_sql = mysql_real_escape_string($nachname, $db_connection);
$mail_sql = mysql_real_escape_string($mail, $db_connection);
$geburtsdatum_sql = mysql_real_escape_string($geburtsdatum, $db_connection);
$showname_sql = mysql_real_escape_string($showname, $db_connection);
$password_sql = mysql_real_escape_string($password1, $db_connection);


$query = "
    INSERT INTO
        tblUser
        (name, vorname, titel, mail, password, groupid, geburtsdatum, showname)
    VALUES
        ('$nachname_sql', '$vorname_sql', '$title_sql', '$mail_sql', md5('$password_sql'), '$geburtsdatum', '$showname', 2)
";

mysql_query($query, $db_connection) or die(mysql_error());
$url = "registred_successfully.php";
echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
echo '</noscript>';
// echo 'Datensätze eingefügt: ', mysql_affected_rows($dbconnection);  
}

echo '
 </td>
    </tr>
    <tr>
      <td>
        </td>
      <td><input type="submit" name="send2" id="send2" value="Senden" /></td>
    </tr>
  </table>
</form>
</body>
</html>
';



echo'</div>
    </div>
</div>
</div>
                <div class="cleared"></div>
                </div>

		<div class="cleared"></div>
    </div>
</div>';

include("includes/sidebar-include.php");
include("includes/footer-incude.php");

?>