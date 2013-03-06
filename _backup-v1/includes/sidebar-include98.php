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
	echo 'Willkommen '.$_SESSION["vorname"].' .<br />';
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><br />
		  <input name="logout" type="submit" id="logout" value="Logout" />
		  </form>';
}
else
{
					
	echo '
					<form action="login.php" method="post">
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