<?php

echo '
 <div class="cleared"></div>
                        </div>

                        <div class="art-layout-cell art-sidebar1">
<div class="art-box art-block">
    <div class="art-box-body art-block-body">
                <div class="art-box art-blockcontent">
                    <div class="art-box-body art-blockcontent-body">';
session_start();
$logout = $_POST["logout"];
if(!empty($logout))
{
	session_destroy();
	$url = $_SERVER['PHP_SELF'];
	echo '<script type="text/javascript">';
	echo 'window.location.href="'.$url.'";';
	echo '</script>';
	echo '<noscript>';
	echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
	echo '</noscript>';
}
	
if(isset($_SESSION["userid"]))
{
	echo 'Willkommen '.$_SESSION["vorname"].'.<br />';
		if($_SESSION["groupid"] == 1)
		{
			echo '<br /><a href="benutzerverwaltung.php">Benutzerverwaltung</a><br />';
		}
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><br />
		  <input name="logout" type="submit" id="logout" value="Logout" />
		  </form>';
}

// Administratoren Menü


else
{
					
	echo '
					<form action="'.$_SERVER['PHP_SELF'].'" method="post">
	<table width="200" border="0" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="144"><p class="art-box-body art-blockcontent-body"><strong>Login</strong></p></td>
		<td width="56">&nbsp;</td>
	  </tr>
	  <tr>
		<td><p class="art-box-body art-blockcontent-body">eMail:</p></td>
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
	<FORM METHOD="LINK" ACTION="./register.php">
	<INPUT TYPE="submit" VALUE="Registrieren">
	</FORM>';
}
if(!empty($_POST["send"]))
{
	##################################################################
	
	# Ist die $_POST Variable submit nicht leer ???
	# dann wurden Logindaten eingegeben, die müssen wir überprüfen !
	if (!empty($_POST["send"]))
		{
		# Die Werte die im Loginformular eingegeben wurden "escapen",
		# damit keine Hackangriffe über den Login erfolgen können !
		# Mysql_real_escape ist auf jedenfall dem Befehle addslashes()
		# vorzuziehen !!! Ohne sind mysql injections möglich !!!!
		$_username = mysql_real_escape_string($_POST["username"]);
		$_passwort = mysql_real_escape_string(md5($_POST["password"]));
	
		# Befehl für die MySQL Datenbank
		$_sql = "SELECT * FROM tblUser WHERE
					Mail='$_username' AND
					Password='$_passwort'
				LIMIT 1";
	
		# Prüfen, ob der User in der Datenbank existiert !
		$_res = mysql_query($_sql, $db);
		$_anzahl = @mysql_num_rows($_res);
	
		# Die Anzahl der gefundenen Einträge überprüfen. Maximal
		# wird 1 Eintrag rausgefiltert (LIMIT 1). Wenn 0 Einträge
		# gefunden wurden, dann gibt es keinen Usereintrag, der
		# gültig ist. Keinen wo der Username und das Passwort stimmt
		# und user_geloescht auch gleich 0 ist !
		if ($_anzahl > 0)
			{
			echo "Der Login war erfolgreich.<br>";
	
			# In der Session merken, dass der User eingeloggt ist !
			$_SESSION["login"] = 1;
	
			# Den Eintrag vom User in der Session speichern !
			$_SESSION["user"] = mysql_fetch_array($_res, MYSQL_ASSOC);
	
			# Das Einlogdatum in der Tabelle setzen !
			#$_sql = "UPDATE login_usernamen SET letzter_login=NOW()
			# 		 WHERE id=".$_SESSION["user"]["id"];
			mysql_query($_sql);
			}
		else
			{
			echo "Die Logindaten sind nicht korrekt.<br>";
			}
		}
	
	# Ist der User eingeloggt ???
	if ($_SESSION["login"] == 1)
		{
		
				
				
			# Hier wäre der User jetzt gültig angemeldet ! Hier kann
			# Programmcode stehen, den nur eingeloggte User sehen sollen !!
			$url = $_SERVER['PHP_SELF'];
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			echo '</noscript>';
			// echo "Hallo, Sie sind erfolgreich eingeloggt !<br>";
			
			##################################################################
			
			
			##################################################################
			
			/*
			$temp = $_SESSION["user"];
			foreach($temp as $user => $name)
				echo $name.'<br />';
			*/
			
			# Variablen definieren
			$temp = $_SESSION["user"];
			
			$_SESSION["userid"] = $temp["UserID"];
			$_SESSION["nachname"] = $temp["Name"];
			$_SESSION["vorname"] = $temp["Vorname"];
			$_SESSION["titel"] = $temp["Titel"];
			$_SESSION["mail"] = $temp["Mail"];
			$_SESSION["groupid"] = $temp["GroupID"];
			
			/*
			
			echo 'User: '.$_SESSION["userid"];
			echo 'Nachname: '.$_SESSION["nachname"];
			echo 'Vorname: '.$_SESSION["vorname"];
			echo 'Titel: '.$_SESSION["titel"];
			echo 'Mail: '.$_SESSION["mail"];
			echo 'Group: '.$_SESSION["groupid"];
			*/
		
		
		
		}
	
}

echo '
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>
<div class="art-box art-block">
    <div class="art-box-body art-block-body">
                <div class="art-box art-blockcontent">
                    <div class="art-box-body art-blockcontent-body">
                <div>
</div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>
<div class="cleared"></div>                
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>
<div class="art-box art-block">
    <div class="art-box-body art-block-body">
                <div class="art-box art-blockcontent">
                    <div class="art-box-body art-blockcontent-body">              
                                		<div class="cleared"></div>
                    </div>
                </div>
		<div class="cleared"></div>
    </div>
</div>

                          <div class="cleared"></div>
                        </div>
                    </div>
                </div>
            </div>
			
';

?>