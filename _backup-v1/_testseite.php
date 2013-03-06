<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Testseite</title>
<link href="style_test.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="index.php" method="post">
<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="144"><p class="art-box-body art-blockcontent-body"><strong>Login</strong></p></td>
    <td width="56">&nbsp;</td>
  </tr>
  <tr>
    <td><p class="art-box-body art-blockcontent-body">Benutzername:</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="username" type="text" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p class="art-box-body art-blockcontent-body">Password:</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>  <input name="password" type="password" id="password" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="send" type="submit" id="send" value="Senden" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
</form>
<FORM METHOD="LINK" ACTION="http://google.ch">
<INPUT TYPE="submit" VALUE="Registrieren">
</FORM>
<p>&nbsp;</p>
<!--Reg Form-->
<?php

error_reporting(0);
$title = $_POST["title"];
$vorname = $_POST["vorname"];
$nachname = $_POST["nachname"];
$mail = $_POST["email"];
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

if(!empty($vorname))
	$return_vorname = ' value="'.$vorname.'"';
if(!empty($nachname))
	$return_nachname = ' value="'.$nachname.'"';
if(!empty($mail))
	$return_mail = ' value="'.$mail.'"';
  

echo '
<form id="register" name="register" method="post" action="_testseite.php">
  <table width="617" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="205"><label for="title">title</label></td>
      <td width="412"><select name="title" id="title">
        <option value="herr"'; if($title == "herr") {echo 'selected="selected"';} echo'>Herr</option>
        <option value="frau"'; if($title == "frau") {echo 'selected="selected"';} echo'>Frau</option>
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
		echo 'Geschafft!';
	

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
?>