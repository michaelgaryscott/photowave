														<div class="cleared"></div>
													</div><!-- close: art-layout-cell -->
												</div><!-- close: art-content-layout-row -->
											</div><!-- close: art-content-layout -->
										</div><!-- close: art-postcontent -->
									</div><!-- close: art-post-inner -->
								</div><!-- close: art-box-body -->
							</div><!-- close: art-box -->
						</div><!-- close: art-layout-cell -->
						<div class="art-layout-cell art-sidebar1">
							<div class="art-box art-block">
								<div class="art-box-body art-block-body">
									<div class="art-box art-blockcontent">
										<div class="art-box-body art-blockcontent-body">
<?php

if (isset($login_out)) {
	echo $login_out;
}

// EINGELOGGT?
if(isset($_SESSION["userid"])) {
	echo 'Willkommen '.$_SESSION["showname"].'.<br />';
	
	// Administratoren Menü
	if($_SESSION["groupid"] == 1) {
		echo '<br /><b>Admin</b>';
		echo '<br /><a href="benutzerverwaltung.php">Benutzerverwaltung</a><br />';
		echo '<a href="photoverwaltung-admin.php">Photoverwaltung</a><br />';
		echo '<br /><b>User</b><br />';
		
	// benutzer Menü
	} elseif($_SESSION["groupid"] == 2) {
		echo '<br /><a href="benutzer.php">Profil bearbeiten</a><br />';
	}
	
	// Allgemeines Menü
	echo '<a href="photoverwaltung.php">Photoverwaltung</a><br />';
	
	// Logout Button
	echo '
	<form action="" method="post"><br />
		<input name="logout" type="submit" id="logout" value="Logout" />
	</form>';
	
// NICHT EINGELOGGT
} else {

	echo '
	<form action="" method="post">
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
	</form>
	<form method="get" action="./register.php">
		<input type="submit" value="Registrieren" />
	</form>';
}
?>
										</div>
									</div>
									<div class="cleared"></div>
								</div>
							</div>
						</div>