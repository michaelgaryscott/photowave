<?php
include 'includes/config.php';
$menu_active = 'Home';
$title = 'Willkommen';
include 'includes/header-include.php';
?>
</br><h3>...auf der Webseite Photowave<h3>
	<ul>
		<li><h2>Photosharing mit der ganzen Welt</h2></li>
		<li><h2>Öffentlich</h2></li>
		<li><h2>Unkompliziert & einfach bedienbar</h2></li>
	</ul>
	
	<table width="100%" border="0" cellpadding="4" cellspacing="0">
		<tr>
			<td align="center"><img src="./images/Photostream.jpg" alt="Thumbnail" width="99%" ></td>
		</tr>
	</table>

<?php

	/*<p>Dies ist unsere Webseite zum Kurs 141 - Datenbanken in Betrieb nehmen und realisieren. Entdecken Sie und haben Sie spass! ;)</p>
		<h2>Features</h2>
		<ul>
			<li>Automatische Erkennung von Microsoft Internet  Explorern, welche der Zeit hinterherhängen.</li>
			<li>Registrierung
				<ul>
					<li>eMail als Benutzername (ist eindeutig)</li>
					<li>eMail Adresse wird aus DNS Einträge (MX, A)  geprüft ob die angegebene Domain existiert.</li>
					<li>eMail komplexität wird überprüft (@, .)</li>
					<li>Tippfehler von Password eingaben werden durch  wiederholen abgefangen.</li>
					<li>Automatisierte Accountanlage ist verhindert  durch Captcha</li>
					<li>Passwörter werden verschlüsselt in die Datenbank  eingetragen.</li>
				</ul>
			</li>
			<li>Nach dem Login besteht eine Session zur Webseite  und funktioniert Seitenübergreifend</li>
			<li>Seite ist Modulartig aufgebaut und die einzelnen  Bausteine eingebunden, wodurch eine hohe Flexibilität entsteht.</li>
		</ul>
	*/
	include 'includes/sidebar-include.php';
	include 'includes/footer-incude.php';
?>